<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Group;
use App\Message;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function openGroup($group_id = 1)
    {
        $group = Group::find($group_id);
        return view('messenger', ['group' => $group]);
    }

    public function newGroup()
    {
        return view('newgroup');
    }

    public function createNewGroup(Request $request)
    {
        $user_ids = explode(',', $request->users);
        if ( !in_array( Auth::id(), $user_ids, false ) ) {
            $user_ids[] = Auth::id();
        }

        $users = User::find($user_ids);     
        $group = Group::create(['name' => $request->group_name]);

        foreach ($users as $user) {
            $role = ( $user->id == Auth::id() ) ? 1 : 0;
            $group->users()->save($user, ['role' => $role]);
        }
        
        return redirect()->route('messenger', ['group' => $group]);
    }
}
