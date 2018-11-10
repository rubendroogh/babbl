<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
	protected $fillable = [
        'content', 'group_id', 'user_id', 'type'
    ];

    protected $appends = [
        'status'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getStatusAttribute()
    {
        if ($this->user_id == Auth::id()) {
            $status = 'sent';
        } elseif ($this->user_id == null) {
            $status = 'info';
        } else{
            $status = 'received';
        }
        return $status;
    }
}
