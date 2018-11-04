<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
	protected $fillable = [
        'content', 'group_id', 'user_id', 'type'
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
        $status = ($this->user_id == Auth::id()) ? 'sent' : 'received';
        return $status;
    }
}
