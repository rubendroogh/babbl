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
        return $messages;
    }

    public function all_group_users($group_id){
        $group = Group::find($group_id);
        return $group->users;
    }

    public function send_message_init(Request $request){
        $pusher = $this->get_pusher_object();
        $message_type = ($request->message_type == null) ? 'string' : $request->message_type;
        $path = '';

        switch ($message_type) {
            case 'image':
                $path = $request->image->store('public/images');
                $content = strstr($path, '/');
                break;
            
            default:
                $content = $request->message;
                break;
        }

        $message = [
            'content' => $content,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id,
            'user_name' => $request->user_name,
            'type' => $message_type,
        ];
        
        $_message = Message::create($message);
        $_message->user_name = $message['user_name'];
        $_message->path = $path;

        $pusher->trigger('messages', 'receive-message-' . $_message->group_id, $_message->toJson());
        
        return $_message; 
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
