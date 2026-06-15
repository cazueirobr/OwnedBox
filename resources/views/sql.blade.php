<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Vulnerability - OwnedBox</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite('resources/css/modulo.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- Header -->
    @include('components.nav')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <!-- Content Card -->
                    <div class="content-card">
                        <!-- Hero Section -->
                        <div class="hero-section">
                            <h2 class="page-title">Vulnerabilidade de SQL Injection</h2>
                            <p class="page-level">Nível: Intermediário</p>
                        </div>

                        <!-- Description Section -->
                        <div class="section-header">
                            <h3 class="section-title">Descrição</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">SQL Injection é uma técnica de injeção de código usada para atacar aplicações que utilizam bancos de dados, na qual comandos SQL maliciosos são inseridos em campos de entrada para execução (por exemplo, para extrair o conteúdo do banco de dados para o atacante).</p>
                        </div>

                        @verbatim
                        <!-- Why it's dangerous -->
                        <div class="section-header">
                            <h3 class="section-title">Por que é perigosa?</h3>
                        </div>
                        <div class="section-content">
                            <div class="danger-box">
                                <p class="box-title">⚠️ O atacante manipula as consultas do banco de dados</p>
                                <p class="section-text">O banco de dados costuma guardar tudo o que há de mais sensível na aplicação. Ao injetar SQL, o atacante pode:</p>
                                <ul class="guide-list">
                                    <li><strong>Vazar o banco inteiro:</strong> dados de usuários, e-mails e senhas (hashes).</li>
                                    <li><strong>Burlar o login</strong> e entrar como administrador sem saber a senha.</li>
                                    <li><strong>Alterar ou apagar dados</strong>, comprometendo a integridade do sistema.</li>
                                    <li><strong>Executar comandos no servidor</strong> em bancos mal configurados, levando ao controle total.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Vulnerable code -->
                        <div class="section-header">
                            <h3 class="section-title">Exemplo de código vulnerável</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">O problema aparece quando a entrada do usuário é <strong>concatenada diretamente</strong> dentro da consulta SQL:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Vulnerável — PHP</div>
                                <pre><code><span class="line">$email = $_POST['email'];</span>
<span class="line">$senha = $_POST['senha'];</span>
<span class="line"></span>
<span class="line"><span class="cmt">// A entrada do usuário vira parte do comando SQL</span></span>
<span class="line bad">$sql = "SELECT * FROM users</span>
<span class="line bad">        WHERE email = '$email' AND senha = '$senha'";</span>
<span class="line"></span>
<span class="line">$resultado = $conn-&gt;query($sql);</span></code></pre>
                            </div>
                        </div>

                        <!-- How the attack works -->
                        <div class="section-header">
                            <h3 class="section-title">Como o ataque funciona</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">No campo de e-mail, o atacante digita um valor que "fecha" a string e comenta o resto da consulta com <code class="inline-code">--</code>:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Entrada maliciosa no campo e-mail</div>
                                <pre><code><span class="line bad">admin@site.com' --</span></code></pre>
                            </div>
                            <p class="section-text" style="margin-top: 10px;">A consulta final fica assim — a verificação da senha é simplesmente ignorada:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Consulta resultante</div>
                                <pre><code><span class="line">SELECT * FROM users</span>
<span class="line bad">WHERE email = 'admin@site.com' -- ' AND senha = '...'</span></code></pre>
                            </div>
                        </div>

                        <!-- Solution -->
                        <div class="section-header">
                            <h3 class="section-title">Como se proteger (Solução)</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">A solução é usar <strong>consultas parametrizadas (prepared statements)</strong>: os dados do usuário viajam separados do comando SQL e nunca são interpretados como código.</p>
                            <div class="code-block secure">
                                <div class="code-header">✓ Seguro — PHP (PDO)</div>
                                <pre><code><span class="line"><span class="cmt">// Os "?" são preenchidos com os dados de forma segura</span></span>
<span class="line good">$sql = "SELECT * FROM users WHERE email = ? AND senha = ?";</span>
<span class="line"></span>
<span class="line good">$stmt = $pdo-&gt;prepare($sql);</span>
<span class="line good">$stmt-&gt;execute([$email, $senha]);</span>
<span class="line"></span>
<span class="line">$resultado = $stmt-&gt;fetch();</span></code></pre>
                            </div>
                            <p class="section-text" style="margin-top: 12px;">No Laravel, o Eloquent já usa prepared statements por baixo dos panos:</p>
                            <div class="code-block secure">
                                <div class="code-header">✓ Seguro — Laravel (Eloquent)</div>
                                <pre><code><span class="line good">User::where('email', $email)-&gt;first();</span></code></pre>
                            </div>
                            <div class="info-box" style="margin-top: 12px;">
                                <p class="box-title">✓ Boas práticas</p>
                                <ul class="guide-list">
                                    <li><strong>Nunca concatene</strong> entrada do usuário na query — use sempre parâmetros.</li>
                                    <li><strong>Use um ORM/Query Builder</strong> (como o Eloquent), que já protege por padrão.</li>
                                    <li><strong>Menor privilégio:</strong> o usuário do banco deve ter só as permissões necessárias.</li>
                                    <li><strong>Não exiba erros de SQL</strong> ao usuário — eles entregam pistas para o atacante.</li>
                                </ul>
                            </div>
                        </div>
                        @endverbatim

                        <!-- Practice Section -->
                        <div class="section-header">
                            <h3 class="section-title">Prática</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Para praticar a exploração desta vulnerabilidade, gere uma instância de vítima e tente obter o token de segurança.</p>
                        </div>
                        <div class="button-container">
                            <button id="btn-generate-victim" class="btn-generate">Gerar Vítima</button>
                        </div>
                        <div id="flag-id-container" style="margin-top: 10px;"></div>

                        <!-- Submit Token Section -->
                        <div class="section-header">
                            <h3 class="section-title">Enviar Token</h3>
                        </div>
                        <div class="form-section">
                            <div class="form-group">
                                <label for="token" class="form-label-custom">Token</label>
                                <input type="text" class="form-control form-input-custom" id="token" placeholder="Digite o token aqui">
                            </div>
                        </div>
                        <div class="button-container">
                            <button id="btn-submit-token" class="btn-submit">Enviar</button>
                            <div id="token-result-container" style="margin-top: 10px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    document.getElementById('btn-generate-victim').addEventListener('click', function() {
        const btn = this;
        const resultBox = document.getElementById('flag-id-container');

        btn.disabled = true;
        btn.textContent = 'Gerando...';
        resultBox.innerHTML = '<span>Iniciando vítima...</span>';

        fetch('/lab/sql/generate-victim', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(async response => {
            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            if (data.success) {
                resultBox.innerHTML = `
                    <div style="margin-top: 12px; padding: 12px; border: 1px solid #38bdf8; border-radius: 10px;">
                        <p style="margin-bottom: 6px;"><b>Vítima gerada com sucesso.</b></p>
                        <p style="margin-bottom: 6px;">
                            <b>Link:</b>
                            <a href="${data.victim_url}" target="_blank" rel="noopener noreferrer">
                                ${data.victim_url}
                            </a>
                        </p>
                        <p style="margin-bottom: 0;"><b>Porta:</b> ${data.port}</p>
                    </div>
                `;
            } else {
                resultBox.innerHTML = '<span style="color:red">' + (data.message || 'Erro ao iniciar laboratório') + '</span>';
            }
        })
.catch(error => {
    console.error(error);

    let message = error && error.message ? error.message : 'Erro ao iniciar laboratório';

    if (error && error.output_up) {
        message += '<br><pre style="white-space: pre-wrap;">' + error.output_up.join("\n") + '</pre>';
    }

    resultBox.innerHTML = '<span style="color:red">' + message + '</span>';
})
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Gerar Vítima';
        });
    });

    document.getElementById('btn-submit-token').addEventListener('click', function() {
        const btn = this;
        const tokenInput = document.getElementById('token');
        const resultBox = document.getElementById('token-result-container');

        btn.disabled = true;
        btn.textContent = 'Validando...';

        fetch('/lab/sql/validate-token', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: tokenInput.value
            })
        })
        .then(async response => {
            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            resultBox.innerHTML = '<span style="color: #10b981; font-weight: bold;">' + data.message + '</span>';
        })
        .catch(error => {
            const message = error && error.message ? error.message : 'Erro ao validar token';
            resultBox.innerHTML = '<span style="color: red; font-weight: bold;">' + message + '</span>';
        })
        .finally(() => {
            btn.disabled = false;
            btn.textContent = 'Enviar';
        });
    });
</script>
</html>
