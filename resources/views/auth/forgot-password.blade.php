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
                <h2 class="form-subtitle">Recuperação de conta</h2>
                <p class="text-secondary text-center">
                    Um email será enviado ao endereço preenchido abaixo com as orientações para recuperação de conta.
                </p>

                <div class="form-input">
                    <label for="email" class="form-input__label">Coloque seu email</label>
                    <input type="email" name="email" id="email" class="form-input__input">

                    <div class="row">
                     
                        <div class="col">
                            <div class="form-input__forgot-password">
                                <a href="{{ route('login') }}">Fazer login</a>
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
