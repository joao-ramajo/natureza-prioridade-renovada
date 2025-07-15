@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('password.confirm') }}" method="POST" class="form">
        <x-back-link />
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
                    <x-form.show-pass />
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
@endsection
