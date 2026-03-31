<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-Vindo</title>
    
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
                            <h1 class="form-title text-center">Bem-Vindo</h1>
                        </div>

                        <!-- Formulário -->
                        <form>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control custom-input" id="email" placeholder="Digite seu e-mail">
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control custom-input" id="password" placeholder="Digite sua senha">
                            </div>

                            <!-- Botão Log in -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary custom-btn">Log in</button>
                            </div>

                            <!-- Link de Registro -->
                            <div class="text-center">
                                <a href="#" class="login-link">Não tem uma conta? registre-se</a>
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
