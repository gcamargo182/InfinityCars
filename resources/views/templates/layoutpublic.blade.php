<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Infinity Cars')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo16x16.ico') }}" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="bd-infinitycars">

<nav class="header-infinitycars">
    <a href="{{ route('veiculos.index') }}" class="header-logo-link">
        <img src="{{ asset('logo.png') }}" alt="Infinity Cars" class="header-logo">
    </a>
    <div class="header-user row">
        @if(session()->has('usuario_logado'))
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="header-login-icon me-2" title="login" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="fas fa-lock"></i>
                    <!-- <span>{{ session('usuario_logado.nome') }}</span> -->
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline" title="Sair">
                    @csrf
                    <button type="submit" class="btn-sair btn btn-danger">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Sair
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="header-login-icon" title="login" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <i class="fas fa-lock"></i>
            </a>
        @endif
    </div>
</nav>

<main class="main-content">
  <div class="container">
    @yield('conteudo')
  </div>
</main>

<footer class="footer-infinitycars">
    <p>&copy; 2025 Infinity Cars. Todos os direitos reservados.</p>
</footer>

<script>
    // Inicializar tooltips do Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

@stack('scripts')
</body>
</html>