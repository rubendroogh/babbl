<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Invite;
use Auth;

class InviteController extends Controller
{
	public function index()
	{
		$invites = Invite::where('user_id', Auth::id())->get();
		return view('invites', ['invites' => $invites]);
	}

	public function accept($id)
	{
		$invite = Invite::find($id);

		// check if user is invited
		if (Auth::id() == $invite->user->id) {
			$invite->group->users()->save(Auth::user(), ['role' => 1]);
			$invite->delete();

			$message = $invite->user->name . ' has been added to the group.';

			Message::create([
	            'content' => $message,
	            'group_id' => $invite->group->id,
	            'user_id' => null,
	            'type' => 'info',
	        ]);

			return redirect()->route('messenger', ['group' => $invite->group]);
		} else{
			return redirect()->route('invites');
		}
	}

	public function decline($id)
	{
		$invite = Invite::find($id);
		$invite->delete();

		return redirect()->route('invites');
	}
}
