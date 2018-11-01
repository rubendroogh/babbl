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

        {{-- Style --}}
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="hero-welcome" style="background-image: url({{ asset('svg/babbl-welcome-bg.svg') }})">
            <div class="row justify-content-center align-items-center">
                <div class="col-8 text-center">
                    <img class="mx-auto" src="{{ asset('svg/babbl-logo.svg') }}" alt="Card image cap" style="width: 7rem;">
                    <h1>Babbl.</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </body>
</html>
