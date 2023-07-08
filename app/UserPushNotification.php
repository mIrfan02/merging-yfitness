<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPushNotification extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function push_notification()
    {
    	return $this->belongsTo(PushNotification::class, 'push_notification_id');
    }
}
