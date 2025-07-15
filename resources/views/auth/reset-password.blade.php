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
                <h2 class="form-subtitle">Informe a nova senha</h2>

                <div class="form-input">
                    <label for="email" class="form-input__label">Digite seu email</label>
                    <input type="email" name="email" id="email" class="form-input__input">
                </div>

                <div class="form-input">
                    <label for="password" class="form-input__label">Coloque sua nova senha</label>
                    <input type="password" name="password" id="password" class="form-input__input">

                    <div class="row">
                        <div class="col">
                            <div class="form-input__show-password">
                                <input type="checkbox" id="showPassCheckbox" class="form-show-password__checkbox">
                                <label for="showPassCheckbox" class="form-show-password__label">Mostrar senha</label>
                            </div>
                        </div>
            
                    </div>
                </div>

                <div class="form-input">
                    <label for="password.confirmation" class="form-input__label">Repita a nova senha</label>
                    <input type="password" name="password.confirmation" id="password.confirmation"
                        class="form-input__input">
                </div>
                <button type="submit" class="form__submit-button">Continuar</button>



            </form>
        </div>

        <div class="col col-md-6 right-side">

        </div>

    </main>
@endsection
