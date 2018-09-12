@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-users">
                <thead>
                    <tr>
                        <th scope="col">Users</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><a href="{{route('messenger', ['user_id' => $user->id])}}">{{$user->name}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <a href="{{ Route('messenger') }}">Messenger</a>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="js/messenger.js"></script>
@endsection
