@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/new_group.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>Babbl.</h1>
@endsection

@section('content')
    <form class="group-form" method="POST" action="{{ Route('createNewGroup') }}">
        @csrf
            <input name="group_name" type="text" id="groupNameInput" aria-describedby="groupNameHelp" placeholder="Group name">
            <small id="groupNameHelp" class="form-text text-muted">Think of something fun and descriptive.</small>
            <input name="users" type="text" aria-describedby="userHelp" id="usersInput">
            <small id="userHelp" class="form-text text-muted">You can search on either name or email.</small>
        <button type="submit">Save</button>
    </form>

@endsection

@section('js-scripts')
    <script src="/js/new_group.js"></script>
@endsection
