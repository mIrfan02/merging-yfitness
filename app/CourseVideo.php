<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'week', 'day', 'img', 'video','title'];
}