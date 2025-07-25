@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('password.confirm') }}" method="POST" class="form">
        @csrf
        <x-alerts.alert />
        <h2 class="form-subtitle">Informe a nova senha</h2>
        <x-form.form-title>Informe a nova senha</x-form.form-title>

        <x-form.input label='Coloque seu email' type='email' name='email' />

        <x-form.input label='Nova senha' type='password' name='password' />
        <x-form.input label='Confirme a senha' type='password_confirmation' name='password_confirmation' />

        <button type="submit" class="form__submit-button">Continuar</button>

        <div class="separator">Ou</div>
        <a href="{{ route('login') }}" class="text-center">Login</a>

    </form>
@endsection
