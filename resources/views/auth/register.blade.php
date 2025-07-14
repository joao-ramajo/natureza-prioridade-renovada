@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/Form/Form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Register/Register.css') }}">
@endsection

@section('content')
    <form action="{{ route('register') }}" method="POST" class="form mx-auto mb-5">
        @csrf
        <h2 class="form-subtitle">Cadastre-se</h2>
        <div class="form-input">
            <label for="email" class="form-input__label">Email</label>
            <input type="email" name="email" id="email" class="form-input__input" value="admin@gmail.com">
            <x-form.input-error>
                @error('email')
                    {{ $message }}
                @enderror
            </x-form.input-error>
        </div>

        <div class="form-input">
            <label for="name" class="form-input__label">Nome</label>
            <input type="text" name="name" id="name" class="form-input__input" value="John Doe">
            <x-form.input-error>
                @error('name')
                    {{ $message }}
                @enderror
            </x-form.input-error>
        </div>
        <div class="form-input">
            <label for="password" class="form-input__label">Senha</label>
            <input type="password" name="password" id="password" class="form-input__input" value="12345678">
            <x-form.input-error>
                @error('password')
                    {{ $message }}
                @enderror
            </x-form.input-error>
            <x-form.show-pass />
        </div>
        <div class="form-input">
            <label for="password_confirmation" class="form-input__label">Confirme a senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input__input"
                value="12345678">
            <x-form.input-error>
                @error('password_confirmation')
                    {{ $message }}
                @enderror
            </x-form.input-error>
        </div>

        <button type="submit" class="form__submit-button">Cadastrar</button>
        <div class="form-checkbox mt-3">
            <input type="checkbox" name="termos" id="termos" class="form-checkbox__input">
            <label for="termos" class="form-checkbox__label">Li e aceito os <a href="">termos e
                    condições</a></label>
        </div>

        <div class="separator">Ou</div>

        <div class="text-center mx-auto w-100">Já tem uma conta ? <a href="{{ route('login') }}"> Faça login</a></div>

    </form>
@endsection
