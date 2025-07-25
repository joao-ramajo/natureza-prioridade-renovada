@extends('layouts.main_layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/Form/Form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Register/Register.css') }}">
@endsection

@section('content')
    <form action="{{ route('register') }}" method="POST" class="mx-auto mb-5" style="max-width: 600px;">
        @csrf

        {{-- Título do formulário --}}
        <h2 class="text-center mb-4" style="font-family: 'Riot', sans-serif;">
            Cadastre-se
        </h2>

        {{-- Campos do formulário --}}
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}"  autofocus />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}"  />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password"  />
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirme a senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  />
        </div>

        {{-- Checkbox termos --}}
        <div class="form-check mb-3">
            <input class="form-check-input @error('termos') is-invalid @enderror" type="checkbox" value="1"
                id="termos" name="termos" {{ old('termos') ? 'checked' : '' }} />
            <label class="form-check-label" for="termos">
                Li e aceito os <a href="#">termos e condições</a>
            </label>
            @error('termos')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Botão submit --}}
        <button type="submit" class="btn btn-success w-100 py-3 fs-5">
            Cadastrar
        </button>

        {{-- Separador --}}
        <div class="separator my-4 text-center">Ou</div>

        {{-- Link para login --}}
        <div class="text-center">
            Já tem uma conta? <a href="{{ route('login') }}">Faça login</a>
        </div>
    </form>



    <script src="{{ asset('assets/js/ShowPass.js') }}"></script>
@endsection
