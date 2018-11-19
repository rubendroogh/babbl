@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>Babbl.</h1>
    <input v-model="search" class="group-search" type="text" placeholder="Zoeken">
    <a href="{{ route('newGroup') }}" class="add-group-button">+</a> 
@endsection

@section('content')
    <h2>User settings</h2>
    <form action="{{ route('updateUser') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nameInput">Name:</label>
            <input id="nameInput" type="text" name="name" class="form-control" value="{{ Auth::User()->name }}">
        </div>
        <input type="submit" class="btn btn-chatboy" value="Save">
    </form>
@endsection

@section('js-scripts')
    <script type="text/javascript" src="{{ asset('js/user_settings.js') }}"></script>
@endsection