<?php

namespace App\Http\Controllers;

use App\Models\ModuleCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class LabController extends Controller
{
    /**
     * Configuração centralizada de cada laboratório.
     * Centralized configuration for each lab.
     *
     * Para adicionar um novo lab basta criar mais uma entrada com:
     * To add a new lab, just create one more entry with:
     *  - path:          pasta do lab na raiz do projeto (contém docker-compose.yml)
     *                   lab folder at the project root (contains docker-compose.yml)
     *  - project_prefix:prefixo do COMPOSE_PROJECT_NAME para isolar instâncias
     *                   COMPOSE_PROJECT_NAME prefix to isolate instances
     *  - flag_env:      nome da variável de ambiente que recebe a flag
     *                   name of the environment variable that receives the flag
     *  - flag_format:   string com placeholder {token} que define o formato da flag
     *                   string with the {token} placeholder that defines the flag format
     *  - session_key:   chave usada na sessão para guardar a flag gerada
     *                   session key used to store the generated flag
     */
    private const LABS = [
        'sql' => [
            'path'           => 'sqli-login-lab-php',
            'project_prefix' => 'sqli_victim_',
            'flag_env'       => 'FLAG_ID',
            'flag_format'    => '{token}',
            'session_key'    => 'sql_lab_flag',
        ],
        'xss' => [
            'path'           => 'xss-cookie-lab-php',
            'project_prefix' => 'xss_victim_',
            'flag_env'       => 'FLAG_COOKIE',
            'flag_format'    => '{token}',
            'session_key'    => 'xss_lab_flag',
        ],
        'fileupload' => [
            'path'           => 'file-upload-lab-php',
            'project_prefix' => 'fileupload_victim_',
            'flag_env'       => 'FLAG_VALUE',
            'flag_format'    => '{token}',
            'session_key'    => 'fileupload_lab_flag',
        ],
    ];

    public function generateVictim(Request $request, string $lab)
    {
        $config = $this->labConfig($lab);
        if ($config === null) {
            return Response::json(['success' => false, 'message' => 'Laboratório desconhecido.'], 404);
        }

        $token = bin2hex(random_bytes(8));
        $flag = str_replace('{token}', $token, $config['flag_format']);
        $port = random_int(5100, 5999);
        $projectName = $config['project_prefix'] . Str::lower(Str::random(10));

        $labPath = base_path($config['path']);
        if (! is_dir($labPath)) {
            return Response::json([
                'success' => false,
                'message' => 'Diretório do laboratório não encontrado: ' . $labPath,
            ], 500);
        }

        $command = 'cd ' . escapeshellarg($labPath)
            . ' && ' . $config['flag_env'] . '=' . escapeshellarg($flag)
            . ' LAB_PORT=' . escapeshellarg((string) $port)
            . ' COMPOSE_PROJECT_NAME=' . escapeshellarg($projectName)
            . ' docker compose up --build -d --force-recreate 2>&1';

        $output = [];
        $return = null;
        exec($command, $output, $return);

        if ($return !== 0) {
            return Response::json([
                'success'     => false,
                'message'     => 'Erro ao iniciar laboratório',
                'command'     => $command,
                'return_code' => $return,
                'output_up'   => $output,
            ], 500);
        }

        session([
            $config['session_key'] => $flag,
        ]);

        $baseUrl = rtrim(config('app.url'), '/');
        $victimUrl = $baseUrl . ':' . $port;

        return Response::json([
            'success'      => true,
            'victim_url'   => $victimUrl,
            'port'         => $port,
            'project_name' => $projectName,
        ]);
    }

    public function validateToken(Request $request, string $lab)
    {
        $config = $this->labConfig($lab);
        if ($config === null) {
            return Response::json(['success' => false, 'message' => 'Laboratório desconhecido.'], 404);
        }

        $request->validate([
            'token'            => ['required', 'string'],
            'duration_seconds' => ['nullable', 'integer', 'min:0'],
        ]);

        $submitted = trim($request->input('token'));
        $expected = session($config['session_key']);

        if (! $expected) {
            return Response::json([
                'success' => false,
                'message' => 'Nenhuma vítima foi gerada ainda.',
            ], 400);
        }

        if (hash_equals($expected, $submitted)) {
            $user = $request->user();
            if ($user) {
                ModuleCompletion::updateOrCreate(
                    ['user_id' => $user->id, 'module_key' => $lab],
                    [
                        'completed_at'     => now(),
                        'duration_seconds' => $request->input('duration_seconds'),
                    ],
                );
            }

            return Response::json([
                'success' => true,
                'message' => 'Token correto! Desafio concluído.',
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Token incorreto.',
        ], 422);
    }

    private function labConfig(string $lab): ?array
    {
        return self::LABS[$lab] ?? null;
    }

    /**
     * Lista das chaves de módulos disponíveis. Usado por views (menu, perfil)
     * para saber quantos módulos existem no total.
     * List of available module keys. Used by views (menu, perfil)
     * to know how many modules exist in total.
     */
    public static function moduleKeys(): array
    {
        return array_keys(self::LABS);
    }
}
