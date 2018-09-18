<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /** -----------------------------------------------------------------------------------------------
     * Constructor
     *
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** -----------------------------------------------------------------------------------------------
     * UserDetailView
     * - Show the detail view of the user
     *
     */
    public function userDetailView()
    {
      $user = Auth::User();

      return view('user/overview');
    }
}
