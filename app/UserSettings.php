<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $table = 'user_settings';

    protected $fillable = ['id','user_id','meta_key','meta_value'];

    protected $hidden = ['created_at','updated_at'];
}
