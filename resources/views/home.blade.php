@extends('layouts.app')

@section('content')
<div class="container">
    <div id="messages" class="row messages"></div>
    <div class="">
        <form id="messageInput" class="message_input py-3" onsubmit="return SendMessage();">
            @csrf
            <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
            <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
            <div class="form-row">
                <div class="col-9">
                    <input class="form-control" id="message" type="text" name="message" autofocus>
                </div>
                <div class="col-3">
                    <input type="submit" class="btn btn-primary" id="sendMessageButton" value="Send">
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/home.js"></script>
@endsection
