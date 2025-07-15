@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <div class="logo">
        <img src="{{ asset('assets/img/logosimp.svg') }}" alt="Logo da NPR">
    </div>
    <main class="main_content row w-100">

        <div class="col col-md-6 left-side">
            <form action="{{ route('password.confirm') }}" method="POST" class="form">
                @csrf
                <h2 class="form-subtitle">Confirme Sua Senha</h2>
                <p class="text-secondary text-center">
                    Para garantir a segurança das operações realizadas em nosso site, pedimos que informe sua senha atual
                    para poder garantir que está é uma operação válida.
                </p>

                <div class="form-input">
                    <label for="password" class="form-input__label">Coloque sua senha</label>
                    <input type="password" name="password" id="password" class="form-input__input">

                    <div class="row">
                        <div class="col">
                            <div class="form-input__show-password">
                                <input type="checkbox" id="showPassCheckbox" class="form-show-password__checkbox">
                                <label for="showPassCheckbox" class="form-show-password__label">Mostrar senha</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-input__forgot-password">
                                <a href="{{ route('password.request') }}">Esqueci minha senha</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="form__submit-button">Continuar</button>

       

            </form>
        </div>

        <div class="col col-md-6 right-side">

        </div>

    </main>
@endsection
