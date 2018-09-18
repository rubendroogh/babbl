@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Gebruiker: {{ Auth::User()->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('editUserView') }}">Wijzig gebruiker gegevens</a>
            </div>
        </div>
    </div>
@endsection
