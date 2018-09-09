@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="messages">
                
            </div>
            <form id="messageInput" class="message_input pt-3">
                @csrf
                <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
                <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
                <div class="form-group row">
                    <div class="col-8">
                        <input class="form-control" id="message" type="text" name="message" autofocus>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" type="button" id="sendMessageButton" onclick="SendMessage()">
                            Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/home.js"></script>
@endsection
