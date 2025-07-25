@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('login') }}" method="POST" class="mx-auto mb-5 form">
        @csrf
        <x-alerts.alert />

        {{-- Título do formulário --}}
        <h2 class="text-center mb-4 form-subtitle">
            Entre em sua conta
        </h2>

        {{-- Campo: Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required autofocus />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Campo: Senha --}}
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required />
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Botão: Entrar --}}
        <button type="submit" class="btn btn-success w-100 py-2 fs-5">
            Entrar
        </button>

        {{-- Link: Esqueci minha senha --}}
        <div class="mt-3 text-center w-100">
            Esqueci minha senha. <a href="{{ route('password.request') }}">Recuperar senha</a>
        </div>

        {{-- Separador --}}
        <div class="separator my-4 text-center">Ou</div>

        {{-- Link: Cadastro --}}
        <div class="text-center w-100">
            Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se aqui!</a>
        </div>
    </form>
@endsection
