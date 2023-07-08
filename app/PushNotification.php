<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    public function course()
    {
    	return $this->belongsTo(Courses::class, 'course_id');
    }

    public function course_category()
    {
    	return $this->belongsTo(CourseCategory::class, 'fitness_goal_id');
    }
}
