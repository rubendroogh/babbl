<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Babbl\BotUtil;
use Pusher\Pusher;
use App\Message;
use App\Group;
use App\User;
use Auth;
use Validator;

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

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['code' => 'success', 'user' => $user]);
    }

    public function all_groups(){
        $groups = Group::all();
        return $groups;
    }

    public function all_group_messages($group_id, Request $request){
        $group = Group::find($group_id);
        $messages = $group->messages()->with('user')->get();
        foreach ($messages as $message){
           $message['status'] = ($message->user == $request->user()) ? 'sent' : 'received';
        }
        return $messages;
    }

    public function all_group_users($group_id){
        $group = Group::find($group_id);
        return $group->users;
    }

    public function send_message_init(Request $request){
        $message_type = ($request->message_type == null) ? 'string' : $request->message_type;
        $message = [
            'content' => $request->message,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'type' => $message_type,
        ];

        return $this->send_message($message);
        // TODO: implement bots or remove
        // $botUtil = new BotUtil();
        // $botUtil->get_bot_message();
    }

    public function send_message($message){
        $pusher = $this->get_pusher_object();

        $message_saved = Message::create($message);

        $data['message'] = $message_saved->content;
        $data['user_id'] = $message_saved->user_id;
        $data['type'] = $message_saved->message_type;
        $data['id'] = $message_saved->id;

        $data['user_name'] = $message['user_name'];

        $data['status'] = ($data['user_id'] == Auth::id()) ? 'send' : 'received';

        $pusher->trigger('messages', 'receive-message-' . $message_saved->group_id, $data);
        
        return $message_saved;    
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
