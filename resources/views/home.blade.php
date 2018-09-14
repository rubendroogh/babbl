@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-users">
                <thead>
                    <tr>
                        <th scope="col">Groups</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $groups as $group )
                    <tr>
                        <td><a href="{{ route('messenger', ['group_id' => $group->id]) }}">{{ $group->name }}</a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td><a href="{{ route('newGroup') }}">Add new group...</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
