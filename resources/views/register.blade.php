<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua conta</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Space Grotesk -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    @vite('resources/css/styles.css')
</head>
<body>
    <div class="main-container">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-100">
                <!-- Coluna do Formulário (Esquerda) -->
                <div class="col-12 col-lg-6">
                    <div class="form-card">
                        <!-- Título -->
                        <div class="mb-4">
                            <h1 class="form-title">Crie sua conta</h1>
                        </div>

                        <!-- Formulário -->
                        <form>
                            <!-- Nome de usuário -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de usuário</label>
                                <input type="text" class="form-control custom-input" id="username">
                            </div>

                            <!-- E-mail -->
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control custom-input" id="email">
                            </div>

                            <!-- Senha -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control custom-input" id="password">
                            </div>

                            <!-- Confirmar Senha -->
                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control custom-input" id="confirmPassword">
                            </div>

                            <!-- Botão Criar Conta -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary custom-btn">Criar conta</button>
                            </div>

                            <!-- Link de Login -->
                            <div class="text-center">
                                <a href="#" class="login-link">Já tem uma conta? Faça login</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Coluna do Logo (Direita) -->
                <div class="col-12 col-lg-6 d-none d-lg-flex">
                    <div class="logo-container">
                        <!-- Substitua o src abaixo com o caminho do seu logo -->
                        <img src="/img/logo_branco_texto.png" alt="Logo" class="logo-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>