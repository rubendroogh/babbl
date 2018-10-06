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
                    @foreach( $invites as $invite )
                    <tr>
                        <td>
                            <span>Invite for {{ $invite->group->name }}</span>
                            <a href="{{ route('declineInvite', ['id' => $invite->id]) }}" class="btn btn-danger float-right">Decline</a>
                            <a href="{{ route('acceptInvite', ['id' => $invite->id]) }}" class="btn btn-success float-right mr-3">Accept</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
