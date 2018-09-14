<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function SendMessage(Request $request){
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

        $data['message'] = $request->message;
        $data['user_id'] = $request->user_id;
        $data['user_name'] = $request->user_name;
        $pusher->trigger('messages', 'receive-message', $data);
    }
}
