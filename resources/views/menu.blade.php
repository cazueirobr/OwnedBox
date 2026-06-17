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
    @include('components.nav')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <!-- Hero Section -->
                    <div class="hero-section">
                        <h2 class="hero-title">Modules</h2>
                        <p class="hero-description">Explore os módulos abaixo para aprender sobre diferentes tipos de vulnerabilidades.</p>
                    </div>

                    <!-- Modules Card -->
                    <div class="modules-card">
                        <div class="modules-header">
                            <h3 class="modules-title">Vulnerability Modules</h3>
                        </div>

                        <!-- XSS Module -->
                        <a href="{{ route('xss') }}" class="module-item">
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
                                @if (in_array('xss', $completedModules))
                                    <span class="status-badge completed">Concluido ✅</span>
                                @endif
                            </div>
                        </a>

                        <!-- File Upload Module -->

                        <a href="{{ route('fileupload') }}" class="module-item">
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
                                @if (in_array('fileupload', $completedModules))
                                    <span class="status-badge completed">Concluido ✅</span>
                                @endif
                            </div>
                        </a>


                        <!-- SQLI Module -->
                        <a href="{{ route('sql') }}" class="module-item">
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
                                @if (in_array('sql', $completedModules))
                                    <span class="status-badge completed">Concluido ✅</span>
                                @endif
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
