@extends('layouts.main_layout')

@section('content')
    <div class="container py-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="max-width: 500px; width: 100%;">
            
            {{-- Cabeçalho com ícone e título --}}
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock-fill text-success" style="font-size: 3rem;"></i>
                <h4 class="mt-2">Confirmação de Senha</h4>
            </div>

            {{-- Mensagem informativa --}}
            <p class="text-secondary text-center mb-4">
                Por questões de segurança, você precisa <strong>confirmar sua senha</strong> para continuar.
                <br>
                Essa etapa protege suas informações em ações sensíveis, como alterar dados ou excluir registros.
            </p>

            {{-- Formulário --}}
            <x-form.form 
                title="" 
                btnLabel="Confirmar" 
                route="password.confirm" 
                method="POST"
            >
                <x-form.input-field 
                    label="Coloque sua senha atual" 
                    type="password" 
                    name="password" 
                />

                <x-form.show-pass />

            </x-form.form>
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
