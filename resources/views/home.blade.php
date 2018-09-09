@extends('layouts.app')

@section('content')
<div class="container">
    <div id="messages" class="row messages"></div>
    <form id="messageInput" class="message_input py-3 row">
        @csrf
        <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
        <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
            <div class="col-9">
                <input class="form-control" id="message" type="text" name="message" autofocus>
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="button" id="sendMessageButton" onclick="SendMessage()">
                    Send
                </button>
            </div>
    </form>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/home.js"></script>
@endsection
