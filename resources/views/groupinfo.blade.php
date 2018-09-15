@extends('layouts.messenger')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <h3>{{$group->name}}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @foreach ($group->users as $user)
                <hr>
                {{$user->name}}<br>
                {{$user->email}}<br>
                {{$user->id}}
            @endforeach
        </div>
    </div>


</div>
@endsection
