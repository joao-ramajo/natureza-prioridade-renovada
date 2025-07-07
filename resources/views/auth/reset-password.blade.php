@extends('layouts.main_layout')

@section('content')
    <x-form.form title='Nova Senha' btnLabel='Enviar' route='password.update' method='POST'>

        <x-form.input-field label="Email" type="email" name="email" value="{{ old('email') }}" />
        <x-form.input-field label="Nova senha" type="password" name="password" value="{{ old('password') }}" />
        <x-form.input-field label="Confirme a senha" type="password" name="password_confirmation"
            value="{{ old('password_confirmation') }}" />
        <x-form.input-field label="" type="hidden" name="token" value="{{ request()->route('token') }}" />
        <x-form.show-pass/>
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
    </x-form.form>

    <script src="{{ asset('assets/js/ShowPass.js') }}"></script>
@endsection
