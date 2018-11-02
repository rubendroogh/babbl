@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('login') }}" class="auth-form">
    @csrf
    <input name="email" type="email" placeholder="E-mail">
    <input name="password" type="password" placeholder="Wachtwoord" style="margin-bottom: 0">
    <small class="forgot-password"><a href="{{ route('password.request') }}">Wachtwoord vergeten?</a></small>
    <button type="submit" style="margin-top: 1rem">{{ __('login') }}</button>
    <small class="register">Nog geen account? <a href="{{ route('register') }}">Registreer</a> je!</small>
</form>

@endsection
