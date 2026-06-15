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
                    <!-- Site Name -->
                    <h1 class="site-name">OwnedBox</h1>
                </div>
            </div>
            <div class="col d-flex align-items-center justify-content-end gap-4">
                <!-- Dashboard Link -->
                <span class="dashboard-link">Dashboard</span>
                <!-- User Dropdown -->
                @auth
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle p-0 user-icon-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="20" height="20" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1735 14.6896C14.9836 12.6326 13.15 11.1576 11.0102 10.4584C13.1858 9.16322 14.228 6.57411 13.5563 4.13287C12.8847 1.69164 10.6648 0 8.13284 0C5.6009 0 3.381 1.69164 2.70936 4.13287C2.03772 6.57411 3.07988 9.16322 5.2555 10.4584C3.11565 11.1568 1.28206 12.6318 0.092216 14.6896C-0.0265727 14.8833 -0.0308864 15.1262 0.0809503 15.324C0.192787 15.5218 0.403154 15.6433 0.630361 15.6414C0.857569 15.6394 1.06582 15.5143 1.17425 15.3146C2.64612 12.7709 5.24768 11.2521 8.13284 11.2521C11.018 11.2521 13.6196 12.7709 15.0914 15.3146C15.1999 15.5143 15.4081 15.6394 15.6353 15.6414C15.8625 15.6433 16.0729 15.5218 16.1847 15.324C16.2966 15.1262 16.2923 14.8833 16.1735 14.6896V14.6896ZM3.75784 5.62713C3.75784 3.21088 5.7166 1.25213 8.13284 1.25213C10.5491 1.25213 12.5078 3.21088 12.5078 5.62713C12.5078 8.04337 10.5491 10.0021 8.13284 10.0021C5.71767 9.99954 3.76042 8.0423 3.75784 5.62713V5.62713Z" fill="white"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('perfil.edit') }}">Editar Perfil</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </div>
</header>
