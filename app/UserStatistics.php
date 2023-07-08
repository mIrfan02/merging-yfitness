<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatistics extends Model
{
    protected $table = 'user_statistics';

    protected $fillable = ['id','user_id','distance_covered','calaries_gain','time_spand','record_date'];

    protected $hidden = ['created_at','updated_at'];
}
