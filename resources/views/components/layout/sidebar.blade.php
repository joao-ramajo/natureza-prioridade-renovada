<input type="checkbox" id="menu-toggle" class="sidebar__checkbox" hidden />

<label for="menu-toggle" class="sidebar__toggle">
    <i class="bi bi-list"></i>
</label>

<aside class="sidebar">
    <nav class="sidebar__nav">
        <ul>
            <li>
                <a href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Início</a>
            </li>
            <li>
                <a href="{{ route('map') }}"><i class="bi bi-map-fill"></i> Mapa</a>
            </li>
            <li>
                <a href="{{ route('pontos') }}"><i class="bi bi-geo-alt-fill"></i> Pontos de Coleta</a>
            </li>
            @auth
                <li>
                    <a href="{{ route('collection_point.index') }}"><i class="bi bi-plus-circle-fill"></i> Cadastrar um
                        ponto de coleta</a>
                </li>
            @endauth
        </ul>

        <div class="separator">NPR</div>
        @guest
            <ul>
                <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Fazer Login</a></li>
                <li><a href="{{ route('register') }}"><i class="bi bi-person-plus-fill"></i> Criar uma conta</a></li>

            </ul>
        @endguest

        @auth
            <ul>
                <li><a href="{{ route('me.profile', ['id' => Crypt::encrypt(Auth::user()->id)]) }}"><i
                            class="bi bi-person-circle"></i> Perfil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-button">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>

        @endauth

    </nav>
</aside>
