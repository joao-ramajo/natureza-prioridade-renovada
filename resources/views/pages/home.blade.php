@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/home/hero/hero.css') }}">
@endsection

@section('content')
    <x-layout.header />

    <section class="hero bg-light d-flex align-items-center justify-content-center min-vh-75 text-center py-5">
        <div class="container">
            <x-alerts.alert />

            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 fw-bold riot">Natureza Prioridade Renovada</h1>
                <p class="lead text-secondary mb-4">
                    A NPR é uma plataforma comprometida em aumentar a visibilidade dos pontos de coleta de resíduos na
                    sua cidade.
                    Facilitamos o acesso da população a locais de descarte correto, promovendo sustentabilidade e
                    cuidado com o meio ambiente.
                </p>
                <p class="mb-4">
                    Oferecemos:
                </p>
                <ul class="list-unstyled mb-4 text-start d-inline-block">
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Cadastro e visualização de pontos de coleta</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Categorias personalizadas para diversos tipos de resíduos</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Mapa interativo para encontrar os pontos mais próximos</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sistema seguro com autenticação via Laravel Fortify</li>
                </ul>
                <br>
                <a href="{{ route('pontos') }}" class="btn btn-success btn-lg shadow-sm">
                    Ver Pontos de Coleta
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
