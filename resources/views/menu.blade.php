<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Módulos de Vulnerabilidades</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite('resources/css/menu.css')
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
                    <span class="dashboard-link">Dashboard</span>
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
                    <!-- Hero Section -->
                    <div class="hero-section">
                        <h2 class="hero-title">Modules</h2>
                        <p class="hero-description">Explore the modules below to learn about different types of vulnerabilities.</p>
                    </div>

                    <!-- Modules Card -->
                    <div class="modules-card">
                        <div class="modules-header">
                            <h3 class="modules-title">Vulnerability Modules</h3>
                        </div>

                        <!-- XSS Module -->
                        <a href="tela4" class="module-item">
                            <div class="module-content">
                                <div class="module-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 3.75H4.5C3.67157 3.75 3 4.42157 3 5.25V10.7606C3 19.1616 10.1081 21.9488 11.5312 22.4222C11.8352 22.5256 12.1648 22.5256 12.4688 22.4222C13.8937 21.9488 21 19.1616 21 10.7606V5.25C21 4.42157 20.3284 3.75 19.5 3.75V3.75ZM19.5 10.7616C19.5 18.1134 13.2797 20.5697 12 20.9972C10.7316 20.5744 4.5 18.12 4.5 10.7616V5.25H19.5V10.7616ZM7.71938 13.2806C7.42632 12.9876 7.42632 12.5124 7.71938 12.2194C8.01243 11.9263 8.48757 11.9263 8.78063 12.2194L10.5 13.9388L15.2194 9.21937C15.5124 8.92632 15.9876 8.92632 16.2806 9.21937C16.5737 9.51243 16.5737 9.98757 16.2806 10.2806L11.0306 15.5306C10.8899 15.6715 10.6991 15.7506 10.5 15.7506C10.3009 15.7506 10.1101 15.6715 9.96937 15.5306L7.71938 13.2806Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="module-info">
                                    <h4 class="module-name">XSS</h4>
                                    <p class="module-description">Cross-Site Scripting (XSS) é um tipo de injeção, na qual scripts maliciosos são inseridos em sites que, de outra forma, seriam confiáveis e legítimos.</p>
                                </div>
                            </div>
                            <div class="module-status">
                                <span class="status-badge completed">Concluido ✅</span>
                            </div>
                        </a>

                        <!-- File Upload Module -->
                        
                        <a href="tela4" class="module-item">
                            <div class="module-content">
                                <div class="module-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 3.75H4.5C3.67157 3.75 3 4.42157 3 5.25V10.7606C3 19.1616 10.1081 21.9488 11.5312 22.4222C11.8352 22.5256 12.1648 22.5256 12.4688 22.4222C13.8937 21.9488 21 19.1616 21 10.7606V5.25C21 4.42157 20.3284 3.75 19.5 3.75V3.75ZM19.5 10.7616C19.5 18.1134 13.2797 20.5697 12 20.9972C10.7316 20.5744 4.5 18.12 4.5 10.7616V5.25H19.5V10.7616ZM7.71938 13.2806C7.42632 12.9876 7.42632 12.5124 7.71938 12.2194C8.01243 11.9263 8.48757 11.9263 8.78063 12.2194L10.5 13.9388L15.2194 9.21937C15.5124 8.92632 15.9876 8.92632 16.2806 9.21937C16.5737 9.51243 16.5737 9.98757 16.2806 10.2806L11.0306 15.5306C10.8899 15.6715 10.6991 15.7506 10.5 15.7506C10.3009 15.7506 10.1101 15.6715 9.96937 15.5306L7.71938 13.2806Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="module-info">
                                    <h4 class="module-name">Upload de Arquivos</h4>
                                    <p class="module-description">Vulnerabilidades de upload de arquivos ocorrem quando uma aplicação web permite que usuários enviem arquivos sem validá-los corretamente.</p>
                                </div>
                            </div>
                            <div class="module-status">
                                <span class="status-badge completed">Concluido ✅</span>
                            </div>
</a>


                        <!-- SQLI Module -->
                        <a href="tela4" class="module-item">
                            <div class="module-content">
                                <div class="module-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.5 3.75H4.5C3.67157 3.75 3 4.42157 3 5.25V10.7606C3 19.1616 10.1081 21.9488 11.5312 22.4222C11.8352 22.5256 12.1648 22.5256 12.4688 22.4222C13.8937 21.9488 21 19.1616 21 10.7606V5.25C21 4.42157 20.3284 3.75 19.5 3.75V3.75ZM19.5 10.7616C19.5 18.1134 13.2797 20.5697 12 20.9972C10.7316 20.5744 4.5 18.12 4.5 10.7616V5.25H19.5V10.7616ZM7.71938 13.2806C7.42632 12.9876 7.42632 12.5124 7.71938 12.2194C8.01243 11.9263 8.48757 11.9263 8.78063 12.2194L10.5 13.9388L15.2194 9.21937C15.5124 8.92632 15.9876 8.92632 16.2806 9.21937C16.5737 9.51243 16.5737 9.98757 16.2806 10.2806L11.0306 15.5306C10.8899 15.6715 10.6991 15.7506 10.5 15.7506C10.3009 15.7506 10.1101 15.6715 9.96937 15.5306L7.71938 13.2806Z" fill="white"/>
                                    </svg>
                                </div>
                                <div class="module-info">
                                    <h4 class="module-name">SQLI</h4>
                                    <p class="module-description">SQL Injection (SQLI) é uma vulnerabilidade de segurança web que permite a um atacante interferir nas consultas que uma aplicação faz ao seu banco de dados.</p>
                                </div>
                            </div>
                            <div class="module-status">
                                <!-- Sem status -->
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
