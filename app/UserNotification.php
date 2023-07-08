<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';

    protected $fillable = ['id','user_id','receive_notifications','receive_newsletter','receive_special_offer'];

    protected $hidden = ['created_at','updated_at'];
}
