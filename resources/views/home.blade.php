@auth
    <p>voce esta logado</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <input type="submit" value="Logout" class="btn btn-outline-secondary">
    </form>

@endauth

@guest
    <p>Voce esta deslogado faça <a href="{{ route('login') }}">Login</a></p>
@endguest
