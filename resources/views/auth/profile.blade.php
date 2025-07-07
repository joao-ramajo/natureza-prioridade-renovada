@extends('layouts.main_layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-2"></i>
                    <h4 class="mb-0">Meu Perfil</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4"><i class="bi bi-person-fill me-1"></i> Nome</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>

                        <dt class="col-sm-4"><i class="bi bi-envelope-fill me-1"></i> Email</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>

                        <dt class="col-sm-4"><i class="bi bi-calendar-check-fill me-1"></i> Conta criada em</dt>
                        <dd class="col-sm-8">{{ $user->created_at->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4"><i class="bi bi-check-circle-fill me-1"></i> Email Verificado</dt>
                        <dd class="col-sm-8">
                            @if($user->hasVerifiedEmail())
                                <span class="badge bg-success">Sim</span>
                            @else
                                <span class="badge bg-warning text-dark">Não</span>
                            @endif
                        </dd>
                    </dl>

                    <a href="#" class="btn btn-outline-success">
                        <i class="bi bi-pencil-square me-1"></i> Editar Perfil
                    </a>
                    <a href="{{ route('password.request') }}" class="btn btn-outline-danger ms-2">
                        <i class="bi bi-key-fill me-1"></i> Alterar Senha
                    </a> 
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
