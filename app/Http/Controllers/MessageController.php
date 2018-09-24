<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Message;

class MessageController extends Controller
{
    public function sendMessage(Request $request){
    	$options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        return $request->message_type;

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

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
}
