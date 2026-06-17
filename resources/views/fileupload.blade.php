<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Vulnerability - OwnedBox</title>

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
                            <h2 class="page-title">Vulnerabilidade de Upload de Arquivos</h2>
                            <p class="page-level">Nível: Intermediário</p>
                        </div>

                        <!-- Description Section -->
                        <div class="section-header">
                            <h3 class="section-title">Descrição</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Vulnerabilidades de upload de arquivos ocorrem quando uma aplicação web aceita arquivos enviados pelo usuário sem validar adequadamente o tipo, conteúdo ou extensão. Isso pode permitir o upload de arquivos maliciosos (como webshells) que, ao serem executados pelo servidor, concedem ao atacante execução remota de código.</p>
                        </div>

                        @verbatim
                        <!-- Why it's dangerous -->
                        <div class="section-header">
                            <h3 class="section-title">Por que é perigosa?</h3>
                        </div>
                        <div class="section-content">
                            <div class="danger-box">
                                <p class="box-title">⚠️ Pode levar à execução remota de código (RCE)</p>
                                <p class="section-text">Se o atacante consegue enviar um arquivo de código (como <code class="inline-code">.php</code>) e depois acessá-lo pelo navegador, o servidor executa esse código. A partir daí ele pode:</p>
                                <ul class="guide-list">
                                    <li><strong>Rodar comandos no servidor</strong> através de uma "webshell".</li>
                                    <li><strong>Assumir o controle total</strong> da aplicação e do servidor.</li>
                                    <li><strong>Ler arquivos sensíveis</strong> (senhas, banco de dados, código-fonte).</li>
                                    <li><strong>Usar o servidor como ponte</strong> para atacar a rede interna ou hospedar malware/phishing.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Vulnerable code -->
                        <div class="section-header">
                            <h3 class="section-title">Exemplo de código vulnerável</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">O código abaixo aceita <strong>qualquer arquivo</strong> e o salva numa pasta pública, mantendo o nome original:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Vulnerável — PHP</div>
                                <pre><code><span class="line"><span class="cmt">// Nenhuma checagem de tipo, extensão ou conteúdo</span></span>
<span class="line">$nomeArquivo = $_FILES['arquivo']['name'];</span>
<span class="line"></span>
<span class="line bad">move_uploaded_file(</span>
<span class="line bad">    $_FILES['arquivo']['tmp_name'],</span>
<span class="line bad">    "uploads/" . $nomeArquivo</span>
<span class="line bad">);</span></code></pre>
                            </div>
                        </div>

                        <!-- How the attack works -->
                        <div class="section-header">
                            <h3 class="section-title">Como o ataque funciona</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">O atacante envia um arquivo chamado <code class="inline-code">shell.php</code> com o conteúdo abaixo:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ shell.php (webshell)</div>
                                <pre><code><span class="line bad">&lt;?php system($_GET['cmd']); ?&gt;</span></code></pre>
                            </div>
                            <p class="section-text" style="margin-top: 10px;">Depois, basta acessar o arquivo pelo navegador para executar comandos no servidor:</p>
                            <div class="code-block vulnerable">
                                <div class="code-header">✗ Acesso no navegador</div>
                                <pre><code><span class="line bad">https://site.com/uploads/shell.php?cmd=cat /etc/passwd</span></code></pre>
                            </div>
                        </div>

                        <!-- Solution -->
                        <div class="section-header">
                            <h3 class="section-title">Como se proteger (Solução)</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Valide o arquivo por <strong>lista branca</strong> (só o que é permitido), confira o tipo real e <strong>renomeie</strong> o arquivo antes de salvar:</p>
                            <div class="code-block secure">
                                <div class="code-header">✓ Seguro — PHP</div>
                                <pre><code><span class="line"><span class="cmt">// 1) Só aceita extensões da lista branca</span></span>
<span class="line">$permitidas = ['jpg', 'png', 'gif'];</span>
<span class="line">$ext = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));</span>
<span class="line"></span>
<span class="line"><span class="cmt">// 2) Confere o tipo real do conteúdo (MIME)</span></span>
<span class="line">$mime = mime_content_type($_FILES['arquivo']['tmp_name']);</span>
<span class="line"></span>
<span class="line good">if (!in_array($ext, $permitidas) || strpos($mime, 'image/') !== 0) {</span>
<span class="line good">    die('Arquivo não permitido');</span>
<span class="line good">}</span>
<span class="line"></span>
<span class="line"><span class="cmt">// 3) Gera um nome aleatório (impede sobrescrita e execução)</span></span>
<span class="line good">$novoNome = bin2hex(random_bytes(16)) . '.' . $ext;</span>
<span class="line">move_uploaded_file($_FILES['arquivo']['tmp_name'], "uploads/" . $novoNome);</span></code></pre>
                            </div>
                            <div class="info-box" style="margin-top: 12px;">
                                <p class="box-title">✓ Boas práticas</p>
                                <ul class="guide-list">
                                    <li><strong>Lista branca</strong> de extensões e tipos MIME — nunca uma lista negra.</li>
                                    <li><strong>Renomeie</strong> o arquivo com um nome aleatório.</li>
                                    <li><strong>Salve fora da raiz web</strong> ou em uma pasta onde o PHP não seja executado.</li>
                                    <li><strong>Limite o tamanho</strong> e, para imagens, reprocesse-as para remover código embutido.</li>
                                    <li><strong>Sirva os arquivos</strong> por um script controlado, em vez de link direto.</li>
                                </ul>
                            </div>
                        </div>
                        @endverbatim

                        <!-- Practice Section -->
                        <div class="section-header">
                            <h3 class="section-title">Prática</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Gere uma instância de vítima. A aplicação permite enviar arquivos <code>.php</code> e executá-los. Faça upload de uma webshell, liste arquivos no servidor e leia a flag armazenada em <code>uploads/flag.txt</code>.</p>
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
    const moduleStartTime = Date.now();

    document.getElementById('btn-generate-victim').addEventListener('click', function() {
        const btn = this;
        const resultBox = document.getElementById('flag-id-container');

        btn.disabled = true;
        btn.textContent = 'Gerando...';
        resultBox.innerHTML = '<span>Iniciando vítima...</span>';

        fetch('/lab/fileupload/generate-victim', {
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

        fetch('/lab/fileupload/validate-token', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                token: tokenInput.value,
                duration_seconds: Math.round((Date.now() - moduleStartTime) / 1000)
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
