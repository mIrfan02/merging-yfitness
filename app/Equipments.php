<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    protected $table = 'equipments';

    protected $fillable = ['id','name','status'];

    protected $hidden = ['created_at','updated_at'];
}
