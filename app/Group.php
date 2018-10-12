<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = [
        'name',
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
        $latestMessage = $this->messages()->latest()->first();
        return $latestMessage;
    }
}