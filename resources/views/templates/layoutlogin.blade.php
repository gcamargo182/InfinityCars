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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="bd-infinitycars">

<nav class="header-infinitycars">
    <a href="{{ route('veiculos.index') }}" class="header-logo-link">
        <img src="{{ asset('logo.png') }}" alt="Infinity Cars" class="header-logo">
    </a>
    <div>
        @auth
        
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="btn-sair btn btn-danger">
                  <i class="fas fa-sign-out-alt me-1"></i>
                  Sair
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="header-login-icon" title="login" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <i class="fas fa-lock"></i>
            </a>
        @endauth
    </div>
</nav>

<ul class="menu">
      <li title="Menu"><a href="#" class="fas fa-bars menu-button">menu</a></li>
      <li title="Home"><a href="{{ route('veiculos.index') }}" class="fas fa-home">Home</a></li>
      <li title="Pesquisar"><a href="#" onclick="alert('Em desenvolvimento')" class="fas fa-search">Pesquisar</a></li>
      <li title="Relatórios"><a href="#" onclick="alert('Em desenvolvimento')" class="fas fa-chart-line">Relatórios</a></li>
      <li title="Painel Administrativo"><a href="#" onclick="alert('Em desenvolvimento')" class="fas fa-cogs">Painel Administrativo</a></li>
</ul>
    
<ul class="menu-bar">
    <li><a href="#" class="menu-button">Menu</a></li>
    <li><a href="{{ route('admin.veiculos.index') }}">Gestão de Veículos</a></li>
    <li><a href="{{ route('admin.tipos.index') }}">Tipos de Veículos</a></li>
    <li><a href="{{ route('admin.marcas.index') }}">Marcas</a></li>
    <li><a href="{{ route('admin.modelos.index') }}">Modelos</a></li>
    <li><a href="{{ route('admin.cores.index') }}">Cores</a></li>
</ul>

<main class="main-content with-sidebar">
  <div class="container">
    @yield('conteudoLogin')
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

// Versão que funciona com ou sem jQuery
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== MENU DEBUG VANILLA JS ===');
    
    const menuBar = document.querySelector('.menu-bar');
    const menuButtons = document.querySelectorAll('.menu-button');
    
    console.log('Menu-bar encontrado:', !!menuBar);
    console.log('Botões encontrados:', menuButtons.length);
    
    // Função de toggle
    function toggleMenu() {
        console.log('=== TOGGLE EXECUTADO ===');
        
        if (menuBar.classList.contains('open')) {
            menuBar.classList.remove('open');
            menuBar.style.width = '0px';
            menuBar.style.height = '0px';
            menuBar.style.setProperty('width', '0px', 'important');
            menuBar.style.setProperty('height', '0px', 'important');
            console.log('❌ Menu FECHADO');
        } else {
            menuBar.classList.add('open');
            menuBar.style.width = '14em';
            menuBar.style.height = 'calc(100vh - 100px)';
            menuBar.style.setProperty('width', '14em', 'important');
            menuBar.style.setProperty('height', 'calc(100vh - 100px)', 'important');
            console.log('✅ Menu ABERTO - Largura: 14em');
        }
        
        console.log('Classes atuais:', menuBar.className);
        console.log('Largura atual:', window.getComputedStyle(menuBar).width);
    }
    
    // Event listeners nos botões - MÚLTIPLAS ESTRATÉGIAS
    menuButtons.forEach(function(button, index) {
        console.log('Adicionando listener ao botão', index + 1, ':', button.textContent.trim());
        
        // Estratégia 1: Click normal
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('=== CLIQUE DETECTADO (click) ===', button.textContent.trim());
            toggleMenu();
        });
        
        // Estratégia 2: Mousedown como backup
        button.addEventListener('mousedown', function(e) {
            e.preventDefault();
            console.log('=== MOUSEDOWN DETECTADO ===', button.textContent.trim());
            setTimeout(toggleMenu, 50);
        });
    });
    
    // Estratégia 3: Event delegation no documento
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('menu-button') || 
            e.target.closest('.menu-button')) {
            e.preventDefault();
            e.stopPropagation();
            console.log('=== CLIQUE DELEGADO ===', e.target.textContent.trim());
            toggleMenu();
        }
    });
    
    // Estratégia 4: Onclick direto nos elementos (força bruta)
    setTimeout(function() {
        document.querySelectorAll('.menu-button').forEach(function(btn) {
            btn.onclick = function(e) {
                e.preventDefault();
                console.log('=== ONCLICK FORÇADO ===', btn.textContent.trim());
                toggleMenu();
                return false;
            };
        });
    }, 1000);
    
    // Função global para teste
    window.testarMenuManual = toggleMenu;
    
    console.log('=== SETUP COMPLETO ===');
    console.log('Para testar: testarMenuManual()');
});

// Backup com jQuery se disponível
if (typeof $ !== 'undefined') {
    $(document).ready(function() {
        console.log('jQuery também disponível, versão:', $.fn.jquery);
    });
}

<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">

</script>

@stack('scripts')

</body>
</html>