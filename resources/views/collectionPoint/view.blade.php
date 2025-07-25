@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/collection-point/view/view.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Form/Form.css') }}">
@endsection
@section('content')
    <x-layout.header></x-layout.header>

    </div>
    <section class="collection-detail">
        <div class="container">
            <a href="{{ url()->previous() }}" class="back-link mx-2">
                <span class="back-link__icon">←</span>
                <span class="back-link__text">Voltar</span>
            </a>
            <x-alerts.alert />
            <div class="collection-detail__wrapper row">
                <div class="col-md-6 mb-5">
                    <div class="collection-detail__gallery">
                        <div class="collection-detail__main-image">
                            <img src="https://placehold.co/600x400" alt="Imagem principal">
                        </div>
                        <div class="collection-detail__thumbs mt-3 d-flex gap-3 bg-sduccess justify-content-between">
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


                        <p class="collection-detail__author mt-2">
                            Cadastrado por <a href="#">{{ $point->user->name }}</a>
                        </p>

                        <div class="row gap-3">
                            @can('user_can_delete', $point)
                                <form action="{{ route('collection_point.destroy', ['id' => Crypt::encrypt($point->id)]) }}"
                                    method="POST" class="col-3">
                                    @method('DELETE')
                                    @csrf

                                    <input type="submit" value="Apagar" class="w-100 btn btn-outline-danger">
                                </form>
                            @endcan
                            @can('user_can_edit', $point)
                                @include('collectionPoint.modal.edit_modal')
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
