@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/pages/home.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h1>Babbl.</h1>
    <input v-model="search" class="group-search" type="text" placeholder="Zoeken">
    <a href="{{ route('newGroup') }}" class="add-group-button">+</a> 
@endsection

@section('content')
    <a class="group hidden" v-for="chat in filteredList" :href="'/messenger/' + chat.id">
        <div class="group-image"></div>
        <div class="group-text">
            <span class="group-name">@{{ chat.name }}</span>
            <p class="group-latest" v-if="chat.latestMessage.type == 'image'">Image</p>
            <p class="group-latest" v-else>@{{ chat.latestMessage.content }}</p>
        </div>
        <p class="group-time">
            @{{ chat.latestMessage.created_at | formatToTime }}
        </p>
        <span class="group-new-number" v-if="chat.amountNewMessages">@{{ chat.amountNewMessages }}</span>
    </a>

    <div class="loading" id="js-loading"></div>
    <h3 v-if="filteredList.length === 0 && search !== ''" class="no-result hidden">Geen resultaat!</h3>
@endsection

@section('js-scripts')
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection