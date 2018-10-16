<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pusher = $this->getPusherObject();

        $message = $this->message
;
        Message::create([
            'content' => $message->message,
            'group_id' => $message->group_id,
            'user_id' => $message->user_id,
            'type' => $message->message_type,
        ]);

        $data['message'] = $message->message;
        $data['user_id'] = $message->user_id;
        $data['user_name'] = $message->user_name;
        $data['type'] = $message->message_type;
        $data['id'] = $message->id;

        $pusher->trigger('messages', 'receive-message-' . $message->group_id, $data);
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
