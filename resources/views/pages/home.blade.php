@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/home/hero/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-card/collection-card.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home/collection-point/collection-point.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>

    <section class="hero container">
        <div class="row align-items-center hero__row">
            <div class="col-md-6 hero__content">
                <h1 class="hero__title">Natureza Prioridade Renovada</h1>
                <p class="hero__text mb-5">Nós, da NPR, estamos empenhados em contribuir para o combate ao descarte
                    irregular
                    de resíduos em nossa cidade. Oferecemos pontos de coleta estrategicamente localizados, um mapa
                    informativo que destaca esses pontos e uma ampla quantidade de informações sobre práticas
                    sustentáveis. Acreditamos que, juntos, podemos fazer a diferença e ajudar a preservar o meio
                    ambiente.</p>
                <a href="/contato" class="hero__cta">Fale Conosco</a>
            </div>

            <div class="col-md-6 hero__image-wrapper">
                <div class="hero__image"></div>
            </div>
        </div>
    </section>

    <section class="row mx-auto container collection-point">
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
                <a href="{{ route('collection_point.view', ['id' => Crypt::encrypt($point->id)]) }}" class="no-text-decoration">
                    <x-collection-point.card :point="$point" />
                </a>
            @endforeach
        </div>
    </section>
@endsection
