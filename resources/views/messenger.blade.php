@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/messenger.css') }}" rel="stylesheet">
@endsection

@section('header')
    <div class="header-image"></div>
    <h2>Henkie</h2>
    <span class="status">online</span>
@endsection

@section('content')
    @foreach ($group->messages as $m)

        <div class="message-clump-wrapper">
            <div class="single-message {{$m->status}}">
                {{$m->content}}
            </div>
        </div>

    @endforeach
@endsection

@section('js-scripts')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="../js/messenger.js"></script>
@endsection