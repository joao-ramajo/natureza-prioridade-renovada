@extends('layouts.main_layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/home/hero/hero.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>

    <section class="hero">
        <div class="container">
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
        </div>
    </section>
@endsection
