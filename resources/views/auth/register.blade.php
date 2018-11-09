@extends('layouts.auth')

@section('content')
<form action="{{ route('register') }}" method="POST" class="auth-form">
    @csrf
    <input type="text" name="name" placeholder="Naam" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Wachtwoord" required>
    <input type="password" name="password_confirmation" placeholder="Wachtwoord herhalen" required>
    <button type="submit">{{ __('register') }}</button>
</form>
@endsection

