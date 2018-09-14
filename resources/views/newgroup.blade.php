@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <form method="POST" action="{{ Route('createNewGroup') }}">
        @csrf
        <div class="form-group">
            <label for="groupNameInput">Group name</label>
            <input name="group_name" type="text" class="form-control" id="groupNameInput" aria-describedby="textHelp" placeholder="Enter name">
            <small id="textHelp" class="form-text text-muted">Think of something fun and descriptive.</small>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
