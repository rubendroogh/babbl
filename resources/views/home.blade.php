@extends('layouts.app')

@section('header')
<input type="text" value="Zoeken">
<div class="add-group-button">+</div>   
@endsection

@section('content')
<div class="groups-container">
    @foreach ($groups as $group)

            <a class="group" href="{{ route('messenger', ['group_id' => $group->id]) }}">
                <div class="group-image"></div>
                <div class="group-text">
                    <span class="group-name">{{ $group->name }}</span>
                    <p class="group-latest">{{ $group->latestMessage()->content }}</p>
                </div>
                <small class="group-time">
                    {{ $group->latestMessage()->created_at->diffForHumans() }}
                </small>
            </a>

    @endforeach
</div>
@endsection
