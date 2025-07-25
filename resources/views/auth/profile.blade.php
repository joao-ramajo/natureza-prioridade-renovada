@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/profile.css') }}">
@endsection
@section('content')
    <x-layout.header></x-layout.header>

    <section class="profile">
        <div class="container">
            <x-alerts.alert />
            
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4 mb-3">
                    <div class="profile-sidebar">
                        <div class="profile-sidebar__header">
                            <img src="https://placehold.co/150x150" alt="Foto de perfil" class="profile-sidebar__image">
                            <div class="profile-sidebar__badges">
                                <span
                                    class="profile-sidebar__badge">Contribuições<br><strong>{{ isset($user->collectionPoints) ? count($user->collectionPoints) : '0' }}</strong></span>
                                <span class="profile-sidebar__badge">Avaliações<br><strong>0</strong></span>
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

                            @if ($user->email_verified_at === null)
                                <form action="{{ route('verification.send') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn w-100 px-0"
                                        onclick="alert('Ao clicar aqui será enviado um email para sua caixa de entrada, por favor verifique.')">
                                        <li class="text-success">
                                            <i class="bi bi-envelope-arrow-down-fill"></i>Verificar conta
                                        </li>
                                    </button>
                                </form>
                            @endif
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
