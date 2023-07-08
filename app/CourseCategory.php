<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_category';

    protected $fillable = ['id', 'title', 'image', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

    public static function selectbox()
    {
        $list = self::select('title', 'id')->where('status', 1)->get();
        $options = [];
        $options[0] = 'Select Category';
        foreach ($list as $item) {
            $options[$item->id] = $item->title;
        }
        return $options;
    }


    public function courseListings()
    {
        return $this->hasMany(CourseListing::class, 'cat_id');
    }
    public function courses()
    {
        return $this->hasManyThrough(Courses::class, CourseListing::class, 'cat_id', 'id', 'id', 'course_id')
            ->where('courses.status', 1);
    }
}
