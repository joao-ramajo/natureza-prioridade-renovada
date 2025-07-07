<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
    <div class="container">

        {{-- Nome da aplicação --}}
        <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
            {{ config('app.name', 'MinhaApp') }}
        </a>

        {{-- Botão do menu mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Conteúdo colapsável --}}
        <div class="collapse navbar-collapse" id="navbarContent">
            {{-- Links úteis - centralizados (ou à esquerda) --}}
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Painel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Sobre</a>
                </li> --}}
                <li class="nav-item"><a href="{{ route('notes') }}" class="nav-link">Notas</a></li>
                <li class="nav-item"><a href="{{ route('collection_point.index') }}" class="nav-link">Ponto de Coleta</a></li>
                <li class="nav-item"><a href="{{ route('map') }}" class="nav-link">Mapa</a></li>
                {{-- <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Usuários</a></li> --}}
            </ul>

            {{-- Autenticado --}}
            @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="text-dark fw-medium">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm" type="submit">Sair</button>
                    </form>
                </div>
            @endauth

            {{-- Visitante --}}
            @guest
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrar</a>
                </div>
            @endguest
        </div>
    </div>
</nav>
