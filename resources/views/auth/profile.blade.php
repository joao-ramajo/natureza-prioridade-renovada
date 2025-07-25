@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/profile.css') }}">
@endsection
@section('content')
    <x-layout.header></x-layout.header>
    {{-- <div class="container py-5">
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
                                @if ($user->hasVerifiedEmail())
                                    <span class="badge bg-success">Sim</span>
                                @else
                                    <span class="badge bg-warning text-dark">Não</span>
                                @endif
                            </dd>
                        </dl>

                        @include('auth.profile.edit_profile_modal')
                        <form action="{{ route('me.destroy', ['id' => Crypt::encrypt(Auth::user()->id)]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Apagar conta" class="btn btn-outline-danger">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

    <section class="profile">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4 mb-3">
                    <div class="profile-sidebar">
                        <div class="profile-sidebar__header">
                            <img src="https://placehold.co/150x150" alt="Foto de perfil" class="profile-sidebar__image">
                            <div class="profile-sidebar__badges">
                                <span class="profile-sidebar__badge">Contribuições<br><strong>5</strong></span>
                                <span class="profile-sidebar__badge">Avaliações<br><strong>5</strong></span>
                            </div>
                        </div>

                        <h3 class="profile-sidebar__name">{{ $user->name }} </h3>
                        <h4>{{ $user->email }}</h4>

                        <ul class="profile-sidebar__menu">
                            @include('auth.profile.edit_profile_modal')
                            {{-- <li><i class="bi bi-shield-lock"></i> Alterar Senha</li> --}}
                            <a href="{{ route('collection_point.index') }}" class="no-text-decoration">
                                <li><i class="bi bi-plus-circle"></i> Cadastrar Ponto</li>
                            </a>
                            {{-- <li><i class="bi bi-trash3"></i> Excluir Ponto</li> --}}
                            <form action="{{ route('me.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- <input type="submit" value="Apagar conta" class="btn btn-outline-danger"> --}}
                                <button type="submit" class="btn w-100 px-0">
                                    <li class="profile-sidebar__delete text-danger">
                                        <i class="bi bi-exclamation-circle"></i> Apagar Conta
                                    </li>
                                </button>
                            </form>
                        </ul>
                    </div>
                </div>

                <!-- Conteúdo -->
                <div class="col col-12 col-md-8 mb-3">
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Contribuições</h4>
                                <div class="profile-content__card">
                                    <h5 class="profile-content__title">Ponto de coleta 1</h5>
                                    <p>Lorem ipsum dolor amet Lorem ipsum dolor amet</p>
                                    <p class="text-muted">Eletrônico - Lâmpadas - Peças eletrônicas</p>
                                    <div class="profile-content__rating">
                                        ★★★★★
                                    </div>
                                    <p class="profile-content__author">Cadastrado por Adriano Peres</p>
                                </div>
                                <div class="profile-content__card">…</div>
                                <div class="profile-content__card">…</div>
                            </div>

                            <div class="col-md-6">
                                <h4>Avaliações</h4>
                                <div class="profile-content__card">
                                    <h5 class="profile-content__title">Ponto de coleta 1</h5>
                                    <p>Lorem ipsum dolor amet Lorem ipsum dolor amet</p>
                                    <p class="text-muted">Eletrônico - Lâmpadas - Peças eletrônicas</p>
                                    <div class="profile-content__rating">
                                        ★★★★★
                                    </div>
                                    <p class="profile-content__author">Cadastrado por Adriano Peres</p>
                                </div>
                                <div class="profile-content__card">…</div>
                                <div class="profile-content__card">…</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
