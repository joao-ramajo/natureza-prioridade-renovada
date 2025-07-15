@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/Form/Form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Register/Register.css') }}">
@endsection

@section('content')
    <form action="{{ route('register') }}" method="POST" class="form mx-auto mb-5">
        @csrf
        <x-form.form-title>Cadastre-se</x-form.form-title>
        <x-form.input label='Email' type='email' name='email' />
        <x-form.input label='Nome' type='text' name='name' />
        <x-form.input label='Senha' type='password' name='password' />
        <x-form.input label='Confirme a senha' type='password_confirmation' name='password_confirmation' />

        <button type="submit" class="form__submit-button">Cadastrar</button>
        <div class="form-checkbox mt-3">
            <input type="checkbox" name="termos" id="termos" class="form-checkbox__input">
            <label for="termos" class="form-checkbox__label">Li e aceito os <a href="">termos e
                    condições</a></label>
        </div>

        <div class="separator">Ou</div>

        <div class="text-center mx-auto w-100">Já tem uma conta ? <a href="{{ route('login') }}"> Faça login</a></div>

    </form>

    <script src="{{ asset('assets/js/ShowPass.js') }}"></script>
@endsection
