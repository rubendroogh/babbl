@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>{{ Auth::User()->name }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('editUserView') }}">Wijzig gebruiker gegevens</a>
            </div>
        </div>
    </div>
@endsection
