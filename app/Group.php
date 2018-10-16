<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = [
        'name',
    ];

    protected $appends = [
        'latestMessage'
    ];

    public function users()
    {
    	return $this->belongsToMany('App\User', 'group_users')->withPivot('role');
    }

    public function messages()
    {
    	return $this->hasMany('App\Message');
    }

    public function latestMessage()
    {
        return $this->messages()->latest()->first();
    }

    public function getLatestMessageAttribute($value) {
        $latestMessage = null;
        if ($this->latestMessage()) {
            $latestMessage = $this->latestMessage();
        }
        return $latestMessage;
    }
}