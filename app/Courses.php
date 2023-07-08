<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';

    protected $fillable = ['id', 'trainer_id', 'title', 'description', 'video', 'image', 'daystocompletion', 'total_weeks', 'week_a_days', 'status'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['Equipments', 'Trainer', 'DayActivity', 'CourseCategories', 'ParentCategories'];

    public function getParentCategoriesAttribute()
    {

        return FitnessGoals::join('course_category_listing as cl', 'fitness_goals.id', '=', 'cl.parent_cat_id')->where('cl.course_id', $this->id)->first();
    }

    public function getCourseCategoriesAttribute()
    {

        return CourseCategory::join('course_category_listing as cl', 'course_category.id', '=', 'cl.cat_id')->where('cl.course_id', $this->id)->first();
    }

    public function getEquipmentsAttribute()
    {

        return Equipments::join('course_equipments as ce', 'equipments.id', '=', 'ce.equipment_id')->select('equipments.id', 'equipments.name')->where('ce.course_id', $this->id)->get();
    }

    public function getTrainerAttribute()
    {

        return User::select('id', 'first_name', 'last_name', 'email')->where('id', $this->trainer_id)->first();
    }

    public function getDayActivityAttribute()
    {

        return CourseDayActivity::select('id', 'week', 'day', 'detail', 'image')->where('course_id', $this->id)->get();
    }

    public static function totalCourseswithDueDate($from = '', $to = '')
    {

        if (empty($from)) $from = date("Y-m-d 00:00:01", strtotime('monday this week'));
        if (empty($to))   $to = date('Y-m-d 23:59:59', strtotime(' +1 day'));
        $to = date('Y-m-d 23:59:59', strtotime(' +1 day', strtotime($to)));
        return self::whereBetween('created_at', [$from, $to])->count();
    }


    public function courseListing()
    {
        return $this->hasOne(CourseListing::class, 'course_id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
