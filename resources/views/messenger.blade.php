@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/messenger.css') }}" rel="stylesheet">
@endsection

@section('header')
    <a href="{{ route('home') }}" class="back-button"></a>
    <div class="header-image"></div>
    <h2>{{$group->name}}</h2>
    <span class="status">online</span>
@endsection

@section('content')
    @foreach ($group->messages as $m)

        <div class="messages {{$m->status}}">
            <p class="message">
                {{$m->content}}
            </p>
        </div>

    @endforeach
    <div class="page-bottom">
        <div class="message-input-wrapper">
            <form id="js-message-form">
                <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
                <input id="group_id" type="hidden" name="_group_id" value="{{ $group->id }}">
                <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
                <input id="message_type" type="hidden" name="_message_type" value="string">
                <span class="file"></span>
                <input type="text" class="message-input" id="js-message-input" placeholder="Typ een bericht…" />
                <span id="js-send" class="send"></span>
            </form>
        </div>
    </div>
@endsection

@section('js-scripts')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="../js/messenger.js"></script>
@endsection