@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form">
        @csrf
        {{-- <h2 class="form-subtitle">Entre em sua conta</h2> --}}
        <x-form.form-title>Entre em sua conta</x-form.form-title>
        <x-form.input label='Email' type='email' name='email' />
        <x-form.input label='Senha' type='password' name='password' />

        <button type="submit" class="form__submit-button">Entrar</button>
        <div class=" mx-auto w-100">
            Esqueci minha senha. <a href="{{ route('password.request') }}"> Recuperar senha</a>
        </div>

        <div class="separator">Ou</div>

        <div class="text-center mx-auto w-100">
            Não tem uma conta ? <a href="{{ route('register') }}"> cadastre-se aqui !</a>
        </div>
    </form>
@endsection
