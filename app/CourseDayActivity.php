<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseDayActivity extends Model
{
    protected $table = 'course_day_activity';

    protected $fillable = ['id','course_id','week','day','detail','image'];

    protected $hidden = ['created_at','updated_at'];
}
