@extends('layouts.main_layout')

@section('content')
    <div class="container py-5">
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
            </div>

            <div class="col-md-6">
                {{-- Espaço para o mapa --}}
                {{-- 
            @if ($point->latitude && $point->longitude)
                <div id="map" style="width: 100%; height: 350px;"></div>
            @else
                <p>Mapa não disponível para este ponto.</p>
            @endif 
            --}}
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

    </div>
@endsection
