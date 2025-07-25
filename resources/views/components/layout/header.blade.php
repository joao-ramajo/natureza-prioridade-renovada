<header class="cabecalho">
    <div class="">
        <a href="{{ route('home') }}" class="no-text-decotarion">
            <div class="cabecalho__logo-container">
                <img src="{{ asset('assets/img/npr-logo-estendida.svg') }}" alt="Logo da NPR"
                    class="cabecalho__logo-image">
            </div>
        </a>
        <x-layout.sidebar></x-layout.sidebar>
    </div>
    <div class="banner">
        @auth
            Bem vindo, veja nossos <a href="{{ route('pontos') }}"> Pontos de Coleta</a> cadastrados !
        @else
            Para acessar todos os recursos,<a href="{{ route('login') }}">Faça login !</a>
        @endauth
    </div>
</header>

<div class="placeholder"></div>
