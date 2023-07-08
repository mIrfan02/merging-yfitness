<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = ['id','title','per_month_fee','total_fee','status'];

    protected $hidden = ['created_at','updated_at'];
}
