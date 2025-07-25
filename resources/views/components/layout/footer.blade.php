<footer class="footer">
    <div class="footer__content">
        <ul class="footer__nav">

            <li class="footer__nav-item"><a href="{{ route('home') }}" class="footer__nav-link">Home</a></li>
            <li class="footer__nav-item"><a href="{{ route('pontos') }}" class="footer__nav-link">Pontos de Coleta</a></li>
            <li class="footer__nav-item"><a href="{{ route('map') }}" class="footer__nav-link">Mapa</a></li>
            @guest
                <li class="footer__nav-item"><a href="{{ route('login') }}" class="footer__nav-link">Login</a></li>
                <li class="footer__nav-item"><a href="{{ route('register') }}" class="footer__nav-link">Cadastre-se</a></li>
            @endguest
        </ul>

        <hr class="footer__separator">

        <div class="footer__bottom">
            <p class="footer__copyright">
                © {{ date('Y') }} Natureza Prioridade Renovada. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>
