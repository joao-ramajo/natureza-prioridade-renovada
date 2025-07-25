@php
    $success = session('success');
    $error = session('error') ?: session('server_error');
@endphp

@if (!empty($success))
    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>
@endif

@if (!empty($error))
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endif

@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success" role="alert">
        Um novo link de verificação foi enviado para o seu email.
    </div>
@endif

@if (session('error') == 'Too many requests.')
    <div class="alert alert-warning" role="alert">
        Muitas tentativas. Por favor, aguarde alguns instantes antes de tentar novamente.
    </div>
@endif
