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

    public function allGroups(){
        $groups = Group::all();
        return $groups;
    }
}
