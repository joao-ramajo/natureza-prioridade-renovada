@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form">
        @csrf
        <h2 class="form-subtitle">Entre em sua conta</h2>
        <div class="form-input">
            <label for="email" class="form-input__label">Email</label>
            <input type="email" name="email" id="email" class="form-input__input" placeholder="admin@gmail.com">
        </div>
        <div class="form-input">
            <label for="password" class="form-input__label">Senha</label>
            <input type="password" name="password" id="password" class="form-input__input" placeholder="1234576">

            <div class="row">
                <div class="col">
                    <div class="form-input__show-password">
                        <input type="checkbox" id="showPassCheckbox" class="form-show-password__checkbox">
                        <label for="showPassCheckbox" class="form-show-password__label">Mostrar
                            senha</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-input__forgot-password">
                        <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="form__submit-button">Entrar</button>

        <div class="separator">Ou</div>

        <div class="text-center mx-auto w-100">Não tem uma conta ? <a href="{{ route('register') }}">
                cadastre-se
                aqui !</a></div>

    </form>
@endsection
