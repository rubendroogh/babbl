@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Gebruiker: {{ Auth::User()->name }}</h1>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('updateUser') }}" method="post">
                @csrf
                <label for="nameInput">Naam:</label><input id="nameInput" type="text" name="name" value="{{ Auth::User()->name }}">
                <input type="submit" value="Update gegevens">
            </form>
        </div>
    </div>
@endsection
