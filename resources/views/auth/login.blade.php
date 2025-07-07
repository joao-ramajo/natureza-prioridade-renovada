@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <x-form.form method="POST" route="login" title="Login" btnLabel="Login">
            <x-form.input-field label="Email" type="email" name="email" />
            <x-form.input-field label="Senha" type="password" name="password" />
            <x-form.show-pass />
            <a href="{{ route('register') }}">Fazer cadastro</a>
            <a href="{{ route('password.request') }}">Esqueci a senha</a>
        </x-form.form>
    </div>
@endsection
