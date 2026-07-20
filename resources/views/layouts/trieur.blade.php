<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TRIEUR RP - RPG TOOLKIT')</title>
    <meta name="description" content="">
    <link rel="icon" href="{{ asset('Image/Toolkit_rpg.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/a65e138171.js" crossorigin="anonymous"></script>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/script.js') }}" defer></script>
</head>

<body class="trieurrp">
<div class="d-flex" id="wrapper">

    {{-- ===================== --}}
    {{-- Menu de gauche        --}}
    {{-- ===================== --}}
    <div id="sidebar-wrapper">

        {{-- Logo / retour home --}}
        <a href="{{ route('home') }}"
           class="d-block text-center text-decoration-none logo mb-4"
           title="Retour à l'accueil"
           data-bs-toggle="tooltip"
           data-bs-placement="right">
            <img src="{{ asset('images/Trieur_rpg.png') }}" />
        </a>

        {{-- Navigation onglets --}}
        <ul class="nav flex-column mb-auto text-center">
            <li class="nav-item active" data-section="accueil">
                <a href="#accueil" class="nav-link text-dark py-2" title="Accueil"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-house-heart" style="font-size:27px;"></i>
                </a>
            </li>
            <li class="nav-item" data-section="ajouter">
                <a href="#ajouter" class="nav-link text-dark py-2 rounded-0" title="Ajouter"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-plus" style="font-size:27px;"></i>
                </a>
            </li>
            <li class="nav-item" data-section="roleplays">
                <a href="#roleplays" class="nav-link py-2 text-dark rounded-0" title="RPS"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-chat-left-text" style="font-size:27px;"></i>
                </a>
            </li>
            <li class="nav-item" data-section="personnages">
                <a href="#personnages" class="nav-link py-2 text-dark rounded-0" title="Personnages"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-person-fill" style="font-size:27px;"></i>
                </a>
            </li>
            <li class="nav-item" data-section="forums">
                <a href="#forums" class="nav-link py-2 text-dark rounded-0" title="Forums"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-laptop" style="font-size:27px;"></i>
                </a>
            </li>
            <li class="nav-item" data-section="faq">
                <a href="#faq" class="nav-link py-2 text-dark rounded-0" title="FAQ"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-question-square-fill" style="font-size:27px;"></i>
                </a>
            </li>
        </ul>

        {{-- ===================== --}}
        {{-- Menu connexion        --}}
        {{-- ===================== --}}
        <div class="connectmenu">
            @guest
                <a href="{{ route('login') }}" class="navboutontrieur" title="Connexion"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-toggle-off"></i>
                </a>
                <a href="{{ route('register') }}" class="navboutontrieur" title="S'enregistrer"
                   data-bs-toggle="tooltip" data-bs-placement="right">
                    <i class="bi bi-pencil-square"></i>
                </a>
            @endguest

            @auth
                <a href="{{ route('logout') }}"
                   class="navboutontrieur"
                   title="Déconnexion"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-toggle-on"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>

    </div>

    {{-- ===================== --}}
    {{-- Contenu principal     --}}
    {{-- ===================== --}}
    <div id="page-content-wrapper">

        {{-- Bouton toggle sidebar --}}
        <nav class="navbar position-fixed">
            <div class="container-fluid">
                <button class="btn" id="sidebarToggle">
                    <i class="bi bi-x-lg" id="sidebarToggleIcon"></i>
                </button>
            </div>
        </nav>

        <div id="content">
            @yield('content')
        </div>

    </div>

</div>

{{-- Footer --}}
@include('partials.footer')

{{-- Scripts additionnels par page --}}
@stack('scripts')

</body>
</html>
