@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/collection-point/view/view.css') }}">
@endsection
@section('content')
    <x-layout.header></x-layout.header>
    {{-- <div class="container py-5">
        <h2 class="mb-4">
            <i class="bi bi-geo-alt-fill text-primary"></i> {{ $point->name }}
        </h2>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <h5>
                    <i class="bi bi-house-door-fill text-success"></i> Endereço
                </h5>
                <p class="fs-6">
                    {{ $point->street }}, {{ $point->number ?? '' }}<br>
                    {{ $point->neighborhood }}<br>
                    {{ $point->city }} - {{ $point->state }}<br>
                    CEP: {{ $point->cep }}<br>
                    @if ($point->complement)
                        Complemento: {{ $point->complement }}<br>
                    @endif
                </p>

                <h5>
                    <i class="bi bi-clock-fill text-warning"></i> Horário de Funcionamento
                </h5>
                <p class="fs-6">
                    <strong>Dias:</strong> {{ $point->days_open }}<br>
                    <strong>Horário:</strong> das {{ $point->open_from }} às {{ $point->open_to }}
                </p>

                <h5>
                    <i class="bi bi-recycle text-info"></i> Tipos de Coleta
                </h5>
                <ul class="list-group list-group-flush">
                    @foreach ($point->categories as $category)
                        <li class="list-group-item px-0">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $category->name }}
                        </li>
                    @endforeach
                </ul>

                @if ($point->description)
                    <h5 class="mt-4">
                        <i class="bi bi-card-text"></i> Descrição
                    </h5>
                    <p class="fs-6">{{ $point->description }}</p>
                @endif

                @if ($point->latitude && $point->longitude)
                    <h5 class="mt-4">
                        <i class="bi bi-geo"></i> Latitude e Longitude
                    </h5>
                    <p class="fs-6">{{ $point->latitude }}  {{ $point->longitude }}</p>
                @endif
            </div>

            <div class="col-md-6">

                <div class="border rounded p-4 text-center text-muted"
                    style="height: 350px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-map" style="font-size: 4rem;"></i>
                    <p class="mt-3">Mapa será exibido aqui em breve</p>
                </div>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> Voltar à lista
        </a>

        @auth
            @if ($point->user_id == Auth::user()->id)
                @include('collectionPoint.modal.edit_modal')
                <form action="{{ route('collection_point.destroy', ['id' => Crypt::encrypt($point->id)]) }}" method="POST">
                    @method('DELETE')
                    @csrf

                    <input type="submit" value="Apagar Ponto" class="btn btn-outline-danger">
                </form>
            @endif
        @endauth

    </div> --}}
    <section class="collection-detail">
        <div class="container">
            <a href="{{ url()->previous() }}" class="back-link">
                <span class="back-link__icon">←</span>
                <span class="back-link__text">Voltar</span>
            </a>
            <div class="collection-detail__wrapper row">
                <!-- Galeria -->
                <div class="col-md-6">
                    <div class="collection-detail__gallery">
                        <div class="collection-detail__main-image">
                            <img src="https://placehold.co/600x400" alt="Imagem principal">
                        </div>
                        <div class="collection-detail__thumbs mt-3 d-flex gap-3">
                            <img src="https://placehold.co/120x120" class="collection-detail__thumb" alt="thumb 1">
                            <img src="https://placehold.co/120x120" class="collection-detail__thumb" alt="thumb 2">
                            <img src="https://placehold.co/120x120" class="collection-detail__thumb" alt="thumb 3">
                        </div>
                    </div>
                </div>

                <!-- Informações -->
                <div class="col-md-6">
                    <div class="collection-detail__info">
                        <h2 class="collection-detail__title">{{ $point->name }}</h2>
                        <p class="collection-detail__description">
                            {{ $point->description }}
                        </p>

                        <p class="collection-detail__label">Tipo de Coleta</p>
                        <p class="collection-detail__text">

                            @foreach ($point->categories as $category)
                                <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $category->name }}
                            @endforeach
                        </p>

                        <p class="collection-detail__label">Endereço</p>
                        <p class="collection-detail__text"> {{ $point->street }} {{ $point->number ?? '' }},
                            {{ $point->neighborhood }},
                            {{ $point->city }} - {{ $point->state }}
                            <br>
                            @if ($point->complement)
                                Complemento: {{ $point->complement }}
                            @endif
                            CEP: {{ $point->cep }}
                        </p>

                        {{-- <a href="#" class="collection-detail__map-link">Ver no Mapa</a> --}}

                        {{-- <div class="collection-detail__rating mt-3">
                            <span class="collection-detail__star is-filled">★</span>
                            <span class="collection-detail__star is-filled">★</span>
                            <span class="collection-detail__star is-filled">★</span>
                            <span class="collection-detail__star is-filled">★</span>
                            <span class="collection-detail__star is-filled">★</span>
                            <span class="collection-detail__review-count">(243)</span>
                        </div> --}}

                        <p class="collection-detail__author mt-2">
                            Cadastrado por <a href="#">{{ $point->user->name }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
