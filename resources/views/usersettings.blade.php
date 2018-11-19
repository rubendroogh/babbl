@extends('layouts.app')

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
