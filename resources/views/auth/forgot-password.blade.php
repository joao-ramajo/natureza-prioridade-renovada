@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="form">
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
        <p class="text-secondary mt-3" style="font-size: .9rem">Caso já tenha solicitado, verifique sua caixa de spam.</p>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

    </form>
@endsection
