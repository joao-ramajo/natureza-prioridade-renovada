@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/point/point.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-card/collection-card.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-point/collection-point.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>
    <x-alerts.alert />
    <div class="mt-5 opacity-0"></div>
    <section class="row mx-auto container collection-point">
        <h2 class="text-center mb-3 title">Pontos de Coleta</h2>
        <div class="col col-md-4 bg-dsuccess ">
            <h3 class="subtitle">Buscar por categoria</h3>
            <form method="GET" action="{{ route('home') }}" class="mb-4 d-flex justify-content-center">
                <select name="category" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="">Todas as categorias</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <div class="d-flex justify-content-center mt-4">
                {{ $points->links() }}
            </div>

        </div>
        <div class="col col-md-8 bg-dandger">
            @foreach ($points as $point)
                <a href="{{ route('collection_point.view', ['id' => Crypt::encrypt($point->id)]) }}"
                    class="no-text-decoration">
                    <x-collection-point.card :point="$point" />
                </a>
            @endforeach
        </div>
    </section>
@endsection
