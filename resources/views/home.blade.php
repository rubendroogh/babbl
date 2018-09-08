@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <div id="messages">
                        
                    </div>
                    <form>
                        @csrf
                        <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
                        <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
                        <div class="form-group">
                            <input class="form-control" id="message" type="text" name="message" autofocus>
                        </div>
                        <button class="btn btn-primary" type="button" id="sendMessageButton" onclick="SendMessage()">
                            Verstuur bericht
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/home.js"></script>
@endsection
