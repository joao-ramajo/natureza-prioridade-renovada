<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/header/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Footer/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Form/Form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login/main.css') }}">
    @yield('head')
</head>

<body>
    {{-- <x-layout.header /> --}}
    {{-- <div class="container mt-3"><x-alerts.alert /></div> --}}
    {{-- <div class="my-5">OASDK</div> --}}
    {{-- <h2>teste</h2> --}}
    <main class="">@yield('content')</main>

    <x-layout.footer />
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

</body>

</html>
