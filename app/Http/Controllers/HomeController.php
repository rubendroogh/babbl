<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Group;
use App\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $groups = User::find($id)->groups;
        return view('home', ['groups' => $groups]);
    }

    public function messenger($group_id = 1)
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
            $group->users()->save($user);
        }
        
        return view('messenger', ['group' => $group]);
    }
}
