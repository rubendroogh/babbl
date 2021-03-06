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

    @yield('head')
</head>
<body>
    <div id="app">
        <div class="hero" style="background-image: url({{ asset('svg/babbl-welcome-bg.svg') }})">
            @yield('header')
            <main-menu
                :menu-items="[
                    {
                        href: '{{route('home')}}',
                        name: 'Home'
                    },
                    {
                        href: '{{route('invites')}}',
                        name: 'Invites'
                    },
                    {
                        href: '{{route('userSettings')}}',
                        name: 'User settings'
                    },
                    {
                        href: '{{route('logOut')}}',
                        name: 'Log out'
                    },
                ]">
            </main-menu>
        </div>
        <div class="content-container" id="content-container">
            @yield('content')
        </div>
        @yield('outside-container')
    </div>
    @yield('js-scripts')
</body>
</html>
