@php
    $success = session('success');
    $error = session('error') ?: session('server_error');
@endphp

@if(!empty($success))
    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>
@endif

@if(!empty($error))
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endif
