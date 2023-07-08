<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubscriptions extends Model
{
    protected $table = 'user_subscriptions';

    protected $fillable = ['id','user_id','per_month_fee','total_fee','fee_charge','payment_id','payment_date'];

    protected $hidden = ['created_at','updated_at'];
}
