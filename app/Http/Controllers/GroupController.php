<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Group;
use App\Invite;
use App\Message;
use Illuminate\Http\Request;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read($group_id = 1, Request $request)
    {
        $group = Group::find($group_id);


        if (!$group->users()->where('user_id', Auth::id())->first()) {
            $request->session()->flash('alert-info', 'You do not have access to this group.');
            return redirect()->route('home');
        } else{
            return view('messenger', ['group' => $group]);
        }
    }

    public function create_form_view()
    {
        return view('newgroup');
    }

    public function create(Request $request)
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

        // Add 'group created by user' message
        Message::create([
            'content' => $group->name . ' was created by ' . Auth::user()->name,
            'group_id' => $group->id,
            'user_id' => null,
            'type' => 'info',
        ]);

        // Send all users invite
        foreach ($users as $user) {
            if ($user->id !== Auth::id()) {
                $this->new_invite($group->id, $user->id);
            }
        }

        // Add creator to group
        $group->users()->save(Auth::user(), ['role' => 1]);
        
        return redirect()->route('messenger', ['group' => $group]);
    }

    public function delete_user(Request $request)
    {
        $group = Group::find($request->group);
        $role = $group->users()->find(Auth::id())->pivot->role;

        if ($role === 1) {
            $user = User::find($request->user);
            $user->groups()->detach($group->id);
        }

        return redirect()->route('messenger', ['group' => $group]);
    }

    public function new_invite($group_id, $user_id)
    {
        $invite = Invite::Create([
            'group_id' => $group_id,
            'user_id'  => $user_id
        ]);

        return $invite;
    }
}
