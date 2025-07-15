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

        <x-form.input label='Email' type='email' name='email' />
        <button type="submit" class="form__submit-button">Continuar</button>
        <p class="text-secondary mt-3" style="font-size: .9rem">Caso já tenha solicitado, verifique sua caixa de spam.</p>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="separator">Ou</div>
        <div class="mx-auto w-100 text-center">
            Faça <a href="{{ route('login') }}">login</a>
        </div>

    </form>
@endsection
