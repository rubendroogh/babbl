<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Invite;
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
        $invite_count = Invite::where('user_id', Auth::id())->count();
        return view('home', ['groups' => $groups, 'invite_count' => $invite_count]);
    }
}
