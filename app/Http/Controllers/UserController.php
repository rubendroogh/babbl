<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

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
     * - Show the detail view of the user.
     *
     */
    public function userDetailView()
    {
        return view('user/overview');
    }

    /** -----------------------------------------------------------------------------------------------
     * EditUserView
     * - Show a form where the user can edit their details.
     */
    public function editUserView()
    {
        return view('user/edit');
    }

    /** -----------------------------------------------------------------------------------------------
     * UpdateUser
     * - Updates db with new user details.
     *
     * @param Request $request
     * @return Route
     */
    public function updateUser(Request $request)
    {
        $user = Auth::user();

        $user->update($request->all());

        return redirect('/user');
    }

    public function allUsers(){
        $users = User::all();
        return $users;
    }
}
