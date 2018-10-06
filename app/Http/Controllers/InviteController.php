<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invite;

class InviteController extends Controller
{
	public function index()
	{
		$invites = Invite::all();
		return view('invites', ['invites', $invites]);
	}

	public function send()
	{

	}

	public function accept()
	{
		
	}
}
