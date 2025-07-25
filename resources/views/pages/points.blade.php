@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/point/point.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-card/collection-card.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-point/collection-point.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>

    <x-alerts.alert />

    <section class="container my-5 collection-point">
        <h2 class="text-center mb-4 fw-bold riot fs-1">Pontos de Coleta</h2>

        <!-- Hero simples explicando a página -->
        <div class="p-4 mb-5 bg-light rounded-3 shadow-sm text-center">
            <p class="mb-0 fs-5 text-muted">
                Encontre aqui os pontos de coleta de resíduos cadastrados na plataforma. Utilize o filtro ao lado para buscar por categoria e veja os detalhes de cada local clicando nos cards.
            </p>
        </div>

        <div class="row g-4">
            <!-- Sidebar filtro -->
            <aside class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h3 class="h5 mb-0">Buscar por Categoria</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('pontos') }}">
                            <select name="category" class="form-select" onchange="this.form.submit()">
                                <option value="">Todas as categorias</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        {{ $points->links() }}
                    </div>
                </div>
            </aside>

            <!-- Lista de pontos - cards 1 por linha -->
            <main class="col-md-8"> 
                <div class="d-flex flex-column gap-3">
                    @forelse ($points as $point)
                        <a href="{{ route('collection_point.view', ['id' => Crypt::encrypt($point->id)]) }}" class="text-decoration-none">
                            <x-collection-point.card :point="$point" />
                        </a>
                    @empty
                        <p class="text-center text-muted">Nenhum ponto de coleta encontrado.</p>
                    @endforelse
                </div>
            </main>
        </div>
    </section>
@endsection
