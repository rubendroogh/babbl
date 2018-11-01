<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Icon -->
        <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Style --}}
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="hero-welcome" style="background-image: url({{ asset('svg/babbl-welcome-bg.svg') }})">
            <img src="{{ asset('svg/babbl-logo.svg') }}" alt="Card image cap" style="width: 7rem;">
            <h1>Babbl.</h1>
        </div>
        <div class="form-container">
            @yield('content')
        </div>
    </body>
</html>
