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

    <div v-for="m in messages" :class="m.status" class="messages hidden">
        <span v-if="m.status === 'info' && m.type === 'string'" class="message">
            @{{m.content}}
        </span>
        <img v-if="m.type === 'image'" class="image" :src="'../storage/' + m.content" />
        <p v-if="m.status !== 'info' && m.type === 'string'" class="message">
            @{{m.content}}
        </p>
    </div>

    <div v-if="!messages" class="loading" id="js-loading"></div>
    <h3 v-if="messages.length === 0 && messagesLoaded" class="no-result hidden">Nog geen berichten!</h3>

    <div class="page-bottom">
        <div class="message-input-wrapper">
            <form id="js-message-form">
                <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
                <input id="group_id" type="hidden" name="_group_id" value="{{ $group->id }}">
                <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
                <input id="message_type" type="hidden" name="_message_type" value="string">
                <input v-on:input="sendImage()" class="file" type="file" name="_image" id="image" accept="image/x-png,image/gif,image/jpeg">
                <input v-model="inputMessage" v-on:keydown.enter="sendMessage()" type="text" class="message-input" id="js-message-input" placeholder="Typ een bericht…" />
                <span v-on:click="sendTextOrVoice()" id="js-send" class="send" :class="{'send-text' : this.inputMessage != ''}"></span>
            </form>
        </div>
    </div>

@endsection

@section('outside-container')
    <div :class="{'voice-ui-open' : voiceMode}" class="voice-ui" id="js-voice-ui">
        <h2>Voice mode</h2>
        <span>Say something!</span>
        <p class="voice-input">@{{voiceInput}}</p>
        <div v-on:click="toggleVoiceUI" class="voice-back-button"></div>
    </div>
@endsection

@section('js-scripts')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="../js/messenger.js"></script>
@endsection