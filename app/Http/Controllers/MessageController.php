<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Message;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
    	$pusher = $this->getPusherObject();

        Message::create([
            'content' => $request->message,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id
        ]);

        $data['message'] = $request->message;
        $data['user_id'] = $request->user_id;
        $data['user_name'] = $request->user_name;
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
            ->where('user_id', '==', $request->user_id)
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
