<?php
session_start();

$dbPath = __DIR__ . '/lab.sqlite';
$flagId = getenv('FLAG_ID') ?: 'ACT{default-user-id}';

function db(): PDO
{
    global $dbPath, $flagId;

    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        id TEXT PRIMARY KEY,
        username TEXT NOT NULL,
        password TEXT NOT NULL,
        role TEXT NOT NULL
    )');

    $count = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();

    if ($count === 0) {
        $stmt = $pdo->prepare('INSERT INTO users (id, username, password, role) VALUES (?, ?, ?, ?)');
        $stmt->execute([$flagId, 'admin', 'super-secret-admin-password', 'admin']);
        $stmt->execute(['student-001', 'student', 'student123', 'student']);
    }

    return $pdo;
}

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$pdo = db();
$error = null;
$queryShown = null;

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Intencionalmente vulnerável para laboratório.
    // NÃO use concatenação de SQL com entrada do usuário em aplicação real.
    $sql = "SELECT id, username, role FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
    $queryShown = $sql;

    try {
        $result = $pdo->query($sql);
        $user = $result ? $result->fetch(PDO::FETCH_ASSOC) : false;

        if ($user) {
            $_SESSION['user'] = $user;
            $_SESSION['last_query'] = $queryShown;
            header('Location: /');
            exit;
        }

        $error = 'Login inválido.';
    } catch (Throwable $e) {
        $error = 'Erro SQL: ' . $e->getMessage();
    }
}

$user = $_SESSION['user'] ?? null;
$lastQuery = $_SESSION['last_query'] ?? $queryShown;
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SQL Injection Login Lab - PHP</title>
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
        .error { background: #7f1d1d; border: 1px solid #ef4444; padding: 12px; border-radius: 10px; }
        .success { background: #064e3b; border: 1px solid #10b981; padding: 12px; border-radius: 10px; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 700px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>SQL Injection Login Lab - PHP</h1>
        <p class="muted">Laboratório local e intencionalmente vulnerável para estudo de bypass lógico via SQL Injection.</p>

        <?php if ($user): ?>
            <div class="success">
                <strong>Login realizado.</strong>
            </div>
            <h2>Dashboard</h2>
            <div class="grid">
                <div>
                    <p><strong>Usuário:</strong> <?= h($user['username']) ?></p>
                    <p><strong>Role:</strong> <?= h($user['role']) ?></p>
                </div>
                <div>
                    <p><strong>ID do usuário:</strong></p>
                    <pre><?= h($user['id']) ?></pre>
                </div>
            </div>

            <?php if ($lastQuery): ?>
                <h3>Query executada</h3>
                <pre><?= h($lastQuery) ?></pre>
            <?php endif; ?>

            <a class="btn" href="/?logout=1">Sair</a>
        <?php else: ?>
            <?php if ($error): ?>
                <p class="error"><?= h($error) ?></p>
            <?php endif; ?>

            <form method="post" action="/">
                <label for="username">Usuário</label>
                <input id="username" name="username" autocomplete="off" placeholder="student">

                <label for="password">Senha</label>
                <input id="password" name="password" type="password" placeholder="student123">

                <button type="submit">Entrar</button>
            </form>

            <h2>Dicas do laboratório</h2>
            <p>Credencial normal:</p>
            <pre>usuário: student
senha: student123</pre>

            <p>Payload de bypass lógico no campo usuário:</p>
            <pre>admin' OR '1'='1' --</pre>
            <p class="muted">No campo senha, coloque qualquer valor.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
