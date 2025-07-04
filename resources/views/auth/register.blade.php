@extends('layouts.main_layout')

@section('content')
    <div class="container">
        <x-form.form method="POST" route="register.store" title="Faça cadastro" btnLabel="Registrar">
            <x-form.input-field label="Email" type="email" name="email" value="{{ old('email') }}" />
            <x-form.input-field label="Nome" type="text" name="name" value="{{ old('name') }}" />
            <x-form.input-field label="Senha" type="password" name="password" />
            <x-form.input-field label="Senha" type="password" name="password_confirmation" />
            <x-form.show-pass />
        </x-form.form>
    </div>
    <script src="{{ asset('assets/js/ShowPass.js') }}"></script>
@endsection
