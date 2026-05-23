<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie sua conta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/styles.css')
</head>
<body>
    <div class="main-container">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-100">
                <div class="col-12 col-lg-6">
                    <div class="form-card">
                        <div class="mb-4">
                            <h1 class="form-title">Crie sua conta</h1>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nome de usuário</label>
                                <input type="text" class="form-control custom-input" id="name" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control custom-input" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control custom-input" id="password" name="password" required>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control custom-input" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary custom-btn">Criar conta</button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="login-link">Já tem uma conta? Faça login</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-lg-6 d-none d-lg-flex">
                    <div class="logo-container">
                        <img src="/img/logo_branco_texto.png" alt="Logo" class="logo-image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>