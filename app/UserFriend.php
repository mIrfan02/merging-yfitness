<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function friend()
    {
    	return $this->belongsTo(User::class, 'friend_id');
    }
}
