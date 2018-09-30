@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert-panel alert-{{ $msg }} p-1 alert">{{ Session::get('alert-' . $msg) }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                    @endif
                @endforeach
            </div>
            <table class="table table-hover table-users">
                <thead>
                    <tr>
                        <th scope="col">Groups</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $groups as $group )
                    <tr>
                        <td>
                            <a href="{{ route('messenger', ['group_id' => $group->id]) }}">
                                <div>
                                    <span>{{ $group->name }}</span>
                                    <br />
                                    <small>
                                        {{ $group->latestMessage()['user']['name'] }}:
                                        {{ $group->latestMessage()['content'] }}
                                    </small>
                                </div>
                            </a>
                        </td>
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
