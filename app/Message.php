<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = [
        'content', 'group_id', 'user_id',
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
