@extends('layouts.messenger')

@section('content')
<div class="container">

    <div id="messages" class="row messages">
        @foreach( $group->messages as $m )
            <div class="fullwidth">
                <div class="message_{{ $m->user_id == Auth::id() ? 'sent' : 'received' }}">{{ $m->content }}</div>
            </div>
        @endforeach
    </div>

    <form id="messageInput" class="message_input py-3 row bg-white" onsubmit="return sendMessage();">
        @csrf
        <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
        <input id="group_id" type="hidden" name="_group_id" value="{{ $group->id }}">
        <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
            <div class="col-9">
                <input class="form-control" id="message" type="text" name="message" autofocus>
            </div>
            <div class="col-3">
                <input type="submit" class="btn btn-primary" id="sendMessageButton" value="Send">
            </div>
    </form>

</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/messenger.js"></script>
@endsection
