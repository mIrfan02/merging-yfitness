<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseListing extends Model
{
    protected $table = 'course_category_listing';

    protected $fillable = ['id','course_id','parent_cat_id','cat_id'];

    protected $hidden = ['created_at','updated_at'];

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
