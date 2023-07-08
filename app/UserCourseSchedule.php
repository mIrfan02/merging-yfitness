<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourseSchedule extends Model
{
    protected $table = 'user_course_schedule';

    protected $fillable = ['id','user_id','course_id','sun','mon','tue','wed','thu','fri','sat','status'];

    protected $hidden = ['created_at','updated_at'];

}
