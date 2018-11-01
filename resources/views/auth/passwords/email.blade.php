@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="auth-form">
    @csrf
    <input type="email" name="email" placeholder="E-mail" required>
    <button type="submit">{{ __('stuur reset link') }}</button>
</form>

@endsection
