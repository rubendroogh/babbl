<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Message;
use App\Group;
use App\User;

class APIController extends Controller
{
    public function allUsers(){
    	$users = User::all();
    	return $users;
    }

    public function allUserGroups($user_id){
        $user = User::find($user_id);
        return $user->groups;
    }

    public function allGroups(){
        $groups = Group::all();
        return $groups;
    }

    public function allGroupMessages($group_id){
        $group = Group::find($group_id);
        $messages = $group->messages()->with('user')->get();
        return $messages;
    }

    public function allGroupUsers($group_id){
        $group = Group::find($group_id);
        return $group->users;
    }

    public function sendMessage(Request $request){
        $pusher = $this->getPusherObject();

        Message::create([
            'content' => $request->message,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'type' => $request->message_type,
        ]);

        $data['message'] = $request->message;
        $data['user_id'] = $request->user_id;
        $data['user_name'] = $request->user_name;
        $data['type'] = $request->message_type;

        $pusher->trigger('messages', 'receive-message-' . $request->group_id, $data);
    }

    public function messageRead(Request $request){
        $pusher = $this->getPusherObject();

        Message::where('group_id', $request->group_id)
            ->where('read', 0)
            ->where('user_id', '!=', $request->user_id)
            ->update([ 'read' => 1 ]);

        $messages = Message::where('group_id', $request->group_id)
            ->where('read', 1)
            ->where('user_id', '!=', $request->user_id)
            ->get();

        $pusher->trigger('messages', 'read-messages', $messages->toJson());     
    }

    public function getPusherObject(){
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        return $pusher;
    }
}
