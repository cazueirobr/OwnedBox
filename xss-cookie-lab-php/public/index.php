<?php
$flag = getenv('FLAG_COOKIE') ?: 'ACT{xss-cookie-lab}';
$cookieName = getenv('FLAG_COOKIE_NAME') ?: 'flag';

// Cookie propositalmente legível por JavaScript para o laboratório.
// NÃO faça isso com dados sensíveis em aplicações reais.
setcookie($cookieName, $flag, [
    'expires' => time() + 3600,
    'path' => '/',
    'secure' => false,
    'httponly' => false,
    'samesite' => 'Lax',
]);

$payload = $_GET['message'] ?? '';
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>XSS Cookie Lab - PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #111827; color: #f9fafb; margin: 0; }
        .wrap { max-width: 880px; margin: 48px auto; padding: 0 20px; }
        .card { background: #1f2937; border: 1px solid #374151; border-radius: 18px; padding: 28px; box-shadow: 0 20px 60px rgba(0,0,0,.35); }
        h1 { margin-top: 0; }
        label { display: block; margin: 16px 0 6px; color: #d1d5db; }
        input { width: 100%; box-sizing: border-box; border-radius: 10px; border: 1px solid #4b5563; background: #111827; color: #f9fafb; padding: 12px; font-size: 16px; }
        button, .btn { margin-top: 18px; display: inline-block; border: 0; border-radius: 10px; padding: 12px 18px; background: #38bdf8; color: #082f49; font-weight: 700; cursor: pointer; text-decoration: none; }
        code, pre { background: #030712; border: 1px solid #374151; border-radius: 10px; color: #e5e7eb; }
        pre { padding: 14px; overflow-x: auto; }
        .muted { color: #9ca3af; }
        .warning { background: #78350f; border: 1px solid #f59e0b; padding: 12px; border-radius: 10px; }
        .success { background: #064e3b; border: 1px solid #10b981; padding: 12px; border-radius: 10px; }
        .output { margin-top: 16px; background: #111827; border: 1px solid #4b5563; border-radius: 10px; padding: 16px; min-height: 48px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 700px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>XSS Cookie Lab - PHP</h1>
        <p class="muted">Laboratório local e intencionalmente vulnerável para estudo de Cross-Site Scripting refletido.</p>

        <p class="warning">
            A flag foi gravada em um cookie sem <code>HttpOnly</code>, então JavaScript consegue ler o valor com <code>document.cookie</code>.
        </p>

        <form method="get" action="/">
            <label for="message">Mensagem para exibir na página</label>
            <input id="message" name="message" autocomplete="off" placeholder="Digite uma mensagem ou um payload XSS">
            <button type="submit">Enviar</button>
        </form>

        <h2>Resultado renderizado</h2>
        <div class="output">
            <?php if ($payload !== ''): ?>
                <!-- Vulnerabilidade proposital: saída sem escape. -->
                <?= $payload ?>
            <?php else: ?>
                <span class="muted">A mensagem enviada aparecerá aqui.</span>
            <?php endif; ?>
        </div>

        <h2>Dicas do laboratório</h2>
        <div class="grid">
            <div>
                <p>Teste normal:</p>
                <pre>Olá, mundo!</pre>
            </div>
            <div>
                <p>Payload para ler os cookies:</p>
                <pre>&lt;script&gt;alert(document.cookie)&lt;/script&gt;</pre>
            </div>
        </div>

        <p>Também é possível abrir direto pela URL:</p>
        <pre>/?message=&lt;script&gt;alert(document.cookie)&lt;/script&gt;</pre>

        <p class="muted">
            Observação: em uma aplicação real, a saída deve ser escapada e cookies sensíveis devem usar <code>HttpOnly</code>, <code>Secure</code> e proteção adequada de sessão.
        </p>
    </div>
</div>
</body>
</html>
