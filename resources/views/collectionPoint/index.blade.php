@extends('layouts.main_layout')

@section('content')
    <x-form.form method="POST" route="collection_point.store" title="Novo ponto de coleta" btnLabel="Cadastrar">

        <x-form.input-field label="Name" type="text" name="name" value="{{ old('name') }}" />

        {{-- address info --}}
        <div class="row mx-auto">
            <x-form.input-field label="cep" type="text" name="cep" value="{{ old('cep') }}"
                rules=" required maxlength=9 " class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Estado" type="text" name="state" value="{{ old('state') }}"
                class="col col-6 px-0 ps-2" />
        </div>
        <div id="cepMessage" class="alert alert-warning d-none "></div>
        <div class="row mx-auto">
            <x-form.input-field label="Rua" type="text" name="street" value="{{ old('street') }}"
                class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Complemento" type="text" name="complement" value="{{ old('complement') }}"
                class="col col-6 px-0 ps-2" />
        </div>
        <div class="row mx-auto">
            <x-form.input-field label="Bairro" type="text" name="neighborhood" value="{{ old('neighborhood') }}"
                class="col col-6 px-0 pe-2" />
            <x-form.input-field label="Cidade" type="text" name="city" value="{{ old('city') }}"
                class="col col-6 px-0 ps-2" />
        </div>

    </x-form.form>

    <script type="module" src="{{ asset('assets/js/masks/cep.js') }}"></script>
@endsection
