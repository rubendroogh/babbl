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

    public function openGroup($group_id = 1, Request $request)
    {
        $group = Group::find($group_id);

        if (!$group->users()->where('user_id', Auth::id())->first()) {
            $request->session()->flash('alert-info', 'You do not have access to this group.');
            return redirect()->route('home');
        } else{
            return view('messenger', ['group' => $group]);
        }
        
    }

    public function newGroup()
    {
        return view('newgroup');
    }

    public function createNewGroup(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|max:255'
        ]);

        $user_ids = explode(',', $request->users);
        if ( !in_array( Auth::id(), $user_ids, false ) ) {
            $user_ids[] = Auth::id();
        }

        $users = User::find($user_ids);     
        $group = Group::create(['name' => $validated['group_name']]);

        foreach ($users as $user) {
            $role = ( $user->id == Auth::id() ) ? 1 : 0;
            $group->users()->save($user, ['role' => $role]);
        }
        
        return redirect()->route('messenger', ['group' => $group]);
    }

    public function deleteUser(Request $request)
    {
        $group = Group::find($request->group);
        $role = $group->users()->find(Auth::id())->pivot->role;

        if ($role === 1) {
            $user = User::find($request->user);
            $user->groups()->detach($group->id);
        }

        return redirect()->route('messenger', ['group' => $group]);
    }
}
