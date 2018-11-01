@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.update') }}" class="auth-form">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Wachtwoord" required>
    <input type="password" name="password" placeholder="Wachtwoord" required>
    <input type="password" name="password_confirmation" placeholder="Wachtwoord herhalen" required>
    <button type="submit">{{ __('reset wachtwoord') }}</button>
</form>

@endsection
