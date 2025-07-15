@extends('layouts.main_layout')

@section('content')
    <x-form.form title='Esqueci minha senha' btnLabel='Enviar' route='password.email' method='POST'>

        <x-form.input-field label="Email" type="email" name="email" value="{{ old('email') }}" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
    </x-form.form>
@endsection
