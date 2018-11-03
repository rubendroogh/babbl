@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>Babbl.</h1>
    <input type="text" placeholder="Zoeken">
    <a href="{{ route('newGroup') }}" class="add-group-button">+</a>  
@endsection

@section('content')
    @foreach ($groups as $group)

        <a class="group" href="{{ route('messenger', ['group_id' => $group->id]) }}">
            <div class="group-image"></div>
            <div class="group-text">
                <span class="group-name">{{ $group->name }}</span>
                <p class="group-latest">{{ $group->latestMessage()->content }}</p>
            </div>
            <p class="group-time">
                {{ $group->latestMessage()->created_at->format('H:i') }}
            </p>
        </a>

    @endforeach
@endsection
