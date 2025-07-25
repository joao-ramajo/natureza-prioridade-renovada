@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <x-layout.header></x-layout.header>
    {{-- <x-form.form method="POST" route="collection_point.store" title="Novo ponto de coleta" btnLabel="Cadastrar"> --}}
    <form method="POST" action="{{ route('collection_point.store') }}" class="container mb-5 form">
        @csrf
        <x-alerts.alert />

        <x-form.input label="" type="hidden" name="user_id" value="{{ Auth::user()->id }}" />


        {{-- address info --}}
        <h5 class="mb-3 form-subtitle">Cadastre um Novo Ponto de Coleta</h5>

        <div class="mb-3">
            <label for="name" class="form-label">Nome do Ponto</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>

        <div class="row mx-auto">
            <div class="col col-6 px-0 pe-2 mb-3">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}"
                    required maxlength="9">
            </div>
            <div class="col col-6 px-0 ps-2 mb-3">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
            </div>
        </div>

        <div id="cepMessage" class="alert alert-warning d-none"></div>

        <div class="row mx-auto">
            <div class="col col-6 px-0 pe-2 mb-3">
                <label for="street" class="form-label">Rua</label>
                <input type="text" class="form-control" id="street" name="street" value="{{ old('street') }}">
            </div>
            <div class="col col-6 px-0 ps-2 mb-3">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complement" name="complement"
                    value="{{ old('complement') }}">
            </div>
        </div>

        <div class="row mx-auto">
            <div class="col col-6 px-0 pe-2 mb-3">
                <label for="neighborhood" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                    value="{{ old('neighborhood') }}">
            </div>
            <div class="col col-6 px-0 ps-2 mb-3">
                <label for="city" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
            </div>
        </div>


        <hr>
        <div class="mb-3">
            <h5 class="mb-3">Tipo de coleta</h5>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="categories-id[]" value="{{ $category->id }}"
                                id="category-{{ $category->id }}" class="form-check-input"
                                @if (is_array(old('categories-id')) && in_array($category->id, old('categories-id'))) checked @endif>
                            <label for="category-{{ $category->id }}" class="form-check-label">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <h5 class="mb-3">Horario de Funcionamento</h5>


            @php
                $days = [
                    'Seg' => 'Segunda-feira',
                    'Ter' => 'Terça-feira',
                    'Qua' => 'Quarta-feira',
                    'Qui' => 'Quinta-feira',
                    'Sex' => 'Sexta-feira',
                    'Sab' => 'Sábado',
                    'Dom' => 'Domingo',
                ];
            @endphp

            <h5>Dias da semana</h5>
            <div class="row mb-3">
                @foreach ($days as $abbr => $day)
                    <div class="col col-md-4 mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="days_open[]" value="{{ $abbr }}"
                                id="day_{{ strtolower($abbr) }}" class="form-check-input"
                                @if (is_array(old('days_open')) && in_array($abbr, old('days_open'))) checked @endif>
                            <label for="day_{{ strtolower($abbr) }}" class="form-check-label">{{ $day }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <h5>Horário de Funcionamento</h5>
                <div class="row">
                    <div class="col col-md-2 col-sm-4 mb-3">
                        <label for="open_from" class="form-label">Abre às</label>
                        <input type="text" class="form-control" id="open_from" name="open_from"
                            value="{{ old('open_from') }}" placeholder="00:00" pattern="\d{2}:\d{2}" required>
                    </div>
                    <div class="col col-md-2 col-sm-4 mb-3">
                        <label for="open_to" class="form-label">Fecha às</label>
                        <input type="text" class="form-control" id="open_to" name="open_to"
                            value="{{ old('open_to') }}" placeholder="00:00" pattern="\d{2}:\d{2}" required>
                    </div>
                </div>
            </div>



            <div class="mb-3">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description" name="description"
                        style="height: 100px">{{ old('description') }}</textarea>
                    <label for="floatingTextarea2">Descrição</label>
                </div>
            </div>
        </div>

        </div>


        {{-- </x-form.form>
     --}}
        <input type="submit" value="Cadastrar" class="btn btn-outline-success btn-lg">

        <form>

            <script type="module" src="{{ asset('assets/js/masks/cep.js') }}"></script>
            <script type="module" src="{{ asset('assets/js/masks/hour.js') }}"></script>
        @endsection
