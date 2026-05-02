<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da Conta - OwnedBox</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/perfil.css')
</head>
<body>
    @include('components.nav')

    <main class="main-content">
        <div class="container-fluid">
            <div class="row g-1 justify-content-center">
                <div class="col-12 col-lg">
                    <div class="content-area">
                        <div class="page-header">
                            <h2 class="page-title">Editar usuário</h2>
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

                        <form method="POST" action="{{ route('users.update', auth()->user()->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-field">
                                <label for="name" class="field-label">Nome de usuário</label>
                                <input type="text" class="field-input" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            <div class="form-field">
                                <label for="email" class="field-label">E-mail</label>
                                <input type="email" class="field-input" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            <div class="form-field">
                                <label for="password" class="field-label">Nova senha</label>
                                <input type="password" class="field-input" id="password" name="password">
                            </div>

                            <div class="form-field">
                                <label for="password_confirmation" class="field-label">Confirmar nova senha</label>
                                <input type="password" class="field-input" id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="button-section">
                                <button type="submit" class="btn-save">Salvar alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>