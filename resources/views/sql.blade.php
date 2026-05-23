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

                        <!-- Practice Section -->
                        <div class="section-header">
                            <h3 class="section-title">Prática</h3>
                        </div>
                        <div class="section-content">
                            <p class="section-text">Para praticar a exploração desta vulnerabilidade, gere uma instância de vítima e tente obter o token de segurança.</p>
                        </div>
                        <div class="button-container">
                            <button class="btn-generate">Gerar Vítima</button>
                        </div>

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
                            <button class="btn-submit">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
