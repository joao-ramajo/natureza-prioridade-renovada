@extends('layouts.form_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
@endsection

@section('content')
    <form action="{{ route('password.confirm') }}" method="POST" class="form">
        @csrf
        <h2 class="form-subtitle">Informe a nova senha</h2>

        <div class="form-input">
            <label for="email" class="form-input__label">Digite seu email</label>
            <input type="email" name="email" id="email" class="form-input__input">
        </div>

        <div class="form-input">
            <label for="password" class="form-input__label">Coloque sua nova senha</label>
            <input type="password" name="password" id="password" class="form-input__input">

            <div class="row">
                <div class="col">
                         <x-form.show-pass />
                </div>

            </div>
        </div>

        <div class="form-input">
            <label for="password.confirmation" class="form-input__label">Repita a nova senha</label>
            <input type="password" name="password.confirmation" id="password.confirmation" class="form-input__input">
        </div>
        <button type="submit" class="form__submit-button">Continuar</button>



    </form>
@endsection
