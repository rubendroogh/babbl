@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <form method="POST" action="{{ Route('createNewGroup') }}">
        @csrf
        <div class="form-group">
            <label for="groupNameInput">Group name</label>
            <input name="group_name" type="text" class="form-control" id="groupNameInput" aria-describedby="groupNameHelp" placeholder="Enter name">
            <small id="groupNameHelp" class="form-text text-muted">Think of something fun and descriptive.</small>
        </div>
        <div class="form-group">
            <label for="usersInput">Add users</label>
            <input name="users" type="text" class="form-control" aria-describedby="userHelp" id="usersInput">
            <small id="userHelp" class="form-text text-muted">You can search on either name or email.</small>
        </div>
        <button type="submit" class="btn btn-chatboy">Save</button>
    </form>
</div>
<script src="/js/new_group.js"></script>
@endsection
