<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chatboy</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        {{-- Style --}}
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="card col-8">
                    <img class="card-img-top mx-auto" src="{{ asset('svg/logo.svg') }}" alt="Card image cap" style="width: 5.5rem;">
                    <hr>
                    <div class="card-body text-center">
                        @if(!Auth::User())
                            <a class="btn btn-chatboy text-light wdt-5 mb-3" href="{{ Route('login') }}" role="button">Login</a>
                            <a class="btn btn-chatboy text-light wdt-5 mb-3" href="{{ Route('register') }}" role="button">Sign up</a>
                        @else
                            <p>Welcome back, {{ Auth::User()->name }}!</p>
                            <a class="btn btn-chatboy text-light wdt-5 mb-3" href="{{ Route('home') }}" role="button">Your groups</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
