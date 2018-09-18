@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Gebruiker: {{ Auth::User()->name }}</h1>
            </div>
        </div>
    </div>
@endsection
