@extends('layouts.main_layout')

@section('content')
<div class="container py-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
            <h3 class="mt-2">{{ env('APP_NAME') }}</h3>
            <h5 class="text-muted">Verificação de Conta</h5>
        </div>

        <p class="text-center text-secondary">
            Para acessar determinados recursos da aplicação, é necessário verificar seu endereço de e-mail.
        </p>
        <p class="text-center text-secondary">
            Verifique sua <strong>caixa de entrada</strong> ou a pasta <strong>spam</strong> e siga as instruções para validar seu perfil.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success text-center">
                Um novo link de verificação foi enviado para seu e-mail!
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST" class="d-grid gap-2">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-envelope-arrow-up me-1"></i> Reenviar e-mail de verificação
            </button>
        </form>
    </div>
</div>
@endsection
