@extends('layouts.messenger')

@section('content')
<div class="container-fluid">
    <div class="group_info collapse" id="collapseGroupInfo">
        <br>

        <div class="row">
            <div class="col-12">
                <h3>{{$group->name}}</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @foreach ($group->users as $user)
                    <hr>
                    {{$user->name}}
                    @if($user->pivot->role === 1)
                        <small>(Admin)</small>
                    @endif
                        <br>
                        {{$user->email}}<br>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row messages">
        <div class="col-12">
            <div id="messages">
                @foreach( $group->messages as $m )
                    <div class="fullwidth">
                        <div class="message_{{ $m->user == Auth::user() ? 'sent' : 'received' }}" translate="no">
                            @if( $m->user != Auth::user() )
                                <small>{{ $m->user->name }}</small>
                                <br>
                            @endif
                            {{ $m->content }}
                            <br>
                            <small>{{ $m->created_at->diffForHumans() }}</small>
                            @if( $m->user == Auth::user() )
                                <small id="messageRead{{ $m->id }}">
                                    <i class="fas fa-check{{ $m->read ? '-double' : '' }}"></i>
                                </small>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row bottom-absolute bg-dark">
        <div class="col-12">
            <form id="messageInput" class="message_input py-3 row">
                @csrf
                <input id="user_id" type="hidden" name="_user_id" value="{{ Auth::user()->id }}">
                <input id="group_id" type="hidden" name="_group_id" value="{{ $group->id }}">
                <input id="user_name" type="hidden" name="_user_name" value="{{ Auth::user()->name }}">
                <input id="message_type" type="hidden" name="_message_type" value="string">
                <div class="col-9">
                    <input class="form-control" id="message" type="text" name="message" autofocus autocomplete="off">
                </div>
                <div class="col-3">
                    <input type="submit" class="btn btn-chatboy" id="sendMessageButton" value="Send">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="/js/messenger.js"></script>
@endsection
