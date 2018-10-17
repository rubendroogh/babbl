<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Message;
use App\Group;
use App\User;

class APIController extends Controller
{
    public function user(Request $request){
        return $request->user();
    }

    public function all_users(){
    	$users = User::all();
    	return $users;
    }

    public function all_user_groups(Request $request){
        return $request->user()->groups;
        $user = User::find($user_id);
        return $user->groups;
    }

    public function all_groups(){
        $groups = Group::all();
        return $groups;
    }

    public function all_group_messages($group_id){
        $group = Group::find($group_id);
        $messages = $group->messages()->with('user')->get();
        return $messages;
    }

    public function all_group_users($group_id){
        $group = Group::find($group_id);
        return $group->users;
    }

    public function send_message(Request $request){
        $pusher = $this->get_pusher_object();

        $message = Message::create([
            'content' => $request->message,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'type' => $request->message_type,
        ]);

        $data['message'] = $request->message;
        $data['user_id'] = $request->user_id;
        $data['user_name'] = $request->user_name;
        $data['type'] = $request->message_type;
        $data['id'] = $message->id;

        $pusher->trigger('messages', 'receive-message-' . $request->group_id, $data);
    }

    public function message_read(Request $request){
        $pusher = $this->get_pusher_object();

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

    public function get_pusher_object(){
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
