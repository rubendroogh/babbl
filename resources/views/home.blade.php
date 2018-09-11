@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Welkom!</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ Route('messenger') }}">Messenger</a>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/messager.js"></script>
@endsection
