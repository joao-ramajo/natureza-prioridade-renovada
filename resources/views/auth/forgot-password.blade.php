@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('password.email') }}" method="POST" class="mx-auto mb-5" style="max-width: 500px;">
        @csrf

        {{-- Título --}}
        <h2 class="form-subtitle text-center mb-3">Recuperação de conta</h2>

        {{-- Instruções --}}
        <p class="text-secondary text-center mb-4">
            Um email será enviado ao endereço preenchido abaixo com as orientações para recuperação de conta.
        </p>

        {{-- Campo: Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Botão: Continuar --}}
        <button type="submit" class="btn btn-success w-100 py-2 fs-5">
            Continuar
        </button>

        {{-- Dica de verificação --}}
        <p class="text-secondary mt-3" style="font-size: .9rem">
            Caso já tenha solicitado, verifique sua caixa de spam.
        </p>

        {{-- Mensagem de status (ex: link enviado) --}}
        @if (session('status'))
            <div class="alert alert-success mt-3">
                {{ session('status') }}
            </div>
        @endif

        {{-- Separador --}}
        <div class="separator my-4 text-center">Ou</div>

        {{-- Link: Fazer login --}}
        <div class="text-center">
            Faça <a href="{{ route('login') }}">login</a>
        </div>
    </form>
@endsection
