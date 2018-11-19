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
     * EditUserView
     * - Show a form where the user can edit their details.
     */
    public function edit_form_view()
    {
        return view('usersettings');
    }

    /** -----------------------------------------------------------------------------------------------
     * UpdateUser
     * - Updates db with new user details.
     *
     * @param Request $request
     * @return Route
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        $user->update($validated);

        return redirect('/user');
    }

    public function index(){
        $users = User::all();
        return $users;
    }
}
