<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseEquipments extends Model
{
    protected $table = 'course_equipments';

    protected $fillable = ['id', 'course_id', 'equipment_id'];

    protected $hidden = ['created_at', 'updated_at'];
    public function equipment()
    {
        return $this->belongsTo(Equipments::class, 'equipment_id');
    }
}
