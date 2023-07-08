<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    protected $table = 'user_logbook';

    protected $fillable = ['id','user_id','course_id','notification_id','subscription_id','activity','detail'];

    protected $hidden = ['created_at','updated_at'];

    public static function add($user_id = null,$activity = null,$detail = null){
        $record  =  new LogBook(); 
        $record->user_id    =  $user_id;
        $record->activity   =  $activity;
        $record->detail     =  $detail;
        $record->save();
        return $record->id;
    }
    public static function getData($user_id = null,$orderBy = 'desc',$limit = 20){
        return self::select('activity','course_id','notification_id','subscription_id')->where('user_id',$user_id)->orderBy('id',$orderBy)->limit($limit)->get();
    }
}
