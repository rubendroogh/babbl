@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/invites.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>Babbl.</h1>
@endsection

@section('content')
    @foreach( $invites as $invite )
        <div class="invite">
            <span>Invite for {{ $invite->group->name }}</span>
            <a href="{{ route('declineInvite', ['id' => $invite->id]) }}" class="">Decline</a>
            <a href="{{ route('acceptInvite', ['id' => $invite->id]) }}" class="">Accept</a>
        </div>
    @endforeach
@endsection

@section('js-scripts')
    <script type="text/javascript" src="{{ asset('js/invites.js') }}"></script>
@endsection