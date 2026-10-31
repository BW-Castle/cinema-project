<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>{{ $title ?? 'Кинотеатр' }} — Синема</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>
<body class="d-flex flex-column min-vh-100">
    {{-- ==================== НАВИГАЦИЯ ==================== --}}
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi-film"></i> Синема
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">🎬 Афиша</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">🎫 Мои билеты</a>
                        </li>
                    @endauth

                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">⚙️ Админка</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">🔐 Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">✍️ Регистрация</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->email }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi-person"></i> Профиль
                                </a>
                                <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                                    @csrf
                                    <button class="btn btn-link text-decoration-none p-0" type="submit">
                                        🔋 Выйти
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- ==================== ОСНОВНОЙ КОНТЕНТ ==================== --}}
    <main class="flex-grow-1 container py-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- ==================== ПОДВАЛ ==================== --}}
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">© 2026 Синема. Все права защищены.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>