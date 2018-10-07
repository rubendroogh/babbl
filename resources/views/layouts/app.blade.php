<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.ico') }}" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/solid.css" integrity="sha384-VGP9aw4WtGH/uPAOseYxZ+Vz/vaTb1ehm1bwx92Fm8dTrE+3boLfF1SpAtB1z7HW" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/fontawesome.css" integrity="sha384-1rquJLNOM3ijoueaaeS5m+McXPJCGdr5HcA03/VHXxcp2kX2sUrQDmFc3jR5i/C7" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
</head>
<body>
    <div id="app" class="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="card-img-top mx-auto" src="{{ asset('svg/logo.svg') }}" style="width: 3rem;">
                </a>         
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <nav id="mobileMenu">
            <div id="menuToggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pl-3">
                    <a class="nav-link" href="{{ route('userDetailView') }}">{{ Auth::User()->name }}</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="{{ route('home') }}">Your groups</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="{{ route('invites') }}">
                        Group invites
                        @if(isset($invite_count) && $invite_count != 0)
                            <span class="badge badge-secondary">{{ $invite_count }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="{{ route('editUserView') }}">Settings</a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</body>
</html>
