@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-users">
                <thead>
                    <tr>
                        <th scope="col">Contacts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $groups as $group )
                    <tr>
                        <td><a href="{{ route('messenger', ['group_id' => $group->id]) }}">{{ $group->name }}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <a href="{{ Route('messenger') }}">Conversation messenger</a>
        </div>
    </div>
</div>
@endsection
