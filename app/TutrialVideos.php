<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutrialVideos extends Model
{
    protected $table = 'tutrial_videos';

    protected $fillable = ['id','caption','video_url','thumbnail','status'];

    protected $hidden = ['created_at','updated_at'];
}
