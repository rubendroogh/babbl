<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;

class APIController extends Controller
{
    public function allUsers(){
    	$users = User::all();
    	return $users;
    }

    public function allUserGroups($user_id){
        $user = User::find($user_id);
        return $user->groups;
    }

    public function allGroups(){
        $groups = Group::all();
        return $groups;
    }

    public function allGroupMessages($group_id){
        $group = Group::find($group_id);
        $messages = $group->messages()->with('user')->get();
        return $messages;
    }

    public function allGroupUsers($group_id){
        $group = Group::find($group_id);
        return $group->users;
    }
}
