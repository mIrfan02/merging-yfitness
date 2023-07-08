<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = ['id','user_id','course_id','week','day','detail','image'];

    public static function myPerformedActivities($userId,$courseId,$orderBy = 'desc',$limit = 20)
    {
        return self::where('user_id',$userId)->where('course_id',$courseId)->orderBy('id',$orderBy)->limit($limit)->get();
    }
}
