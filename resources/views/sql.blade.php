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
    <header class="site-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Logo -->
                        <div class="logo-box">
                            <img src="/img/logo_branco_texto.png" alt="OwnedBox" class="header-logo">
                        </div>
                        <!-- Nome do Site -->
                        <h1 class="site-name">OwnedBox</h1>
                    </div>
                </div>
                <div class="col d-flex align-items-center justify-content-end gap-4">
                    <!-- Dashboard Link -->
                    <a href="dashboard.html" class="dashboard-link">Dashboard</a>
                    <!-- User Icon -->
                    <button class="user-icon-btn">
                        <svg width="20" height="20" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1735 14.6896C14.9836 12.6326 13.15 11.1576 11.0102 10.4584C13.1858 9.16322 14.228 6.57411 13.5563 4.13287C12.8847 1.69164 10.6648 0 8.13284 0C5.6009 0 3.381 1.69164 2.70936 4.13287C2.03772 6.57411 3.07988 9.16322 5.2555 10.4584C3.11565 11.1568 1.28206 12.6318 0.092216 14.6896C-0.0265727 14.8833 -0.0308864 15.1262 0.0809503 15.324C0.192787 15.5218 0.403154 15.6433 0.630361 15.6414C0.857569 15.6394 1.06582 15.5143 1.17425 15.3146C2.64612 12.7709 5.24768 11.2521 8.13284 11.2521C11.018 11.2521 13.6196 12.7709 15.0914 15.3146C15.1999 15.5143 15.4081 15.6394 15.6353 15.6414C15.8625 15.6433 16.0729 15.5218 16.1847 15.324C16.2966 15.1262 16.2923 14.8833 16.1735 14.6896V14.6896ZM3.75784 5.62713C3.75784 3.21088 5.7166 1.25213 8.13284 1.25213C10.5491 1.25213 12.5078 3.21088 12.5078 5.62713C12.5078 8.04337 10.5491 10.0021 8.13284 10.0021C5.71767 9.99954 3.76042 8.0423 3.75784 5.62713V5.62713Z" fill="white"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

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
