<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FitnessGoals extends Model
{
    protected $table = 'fitness_goals';

    protected $fillable = ['id','name','status'];

    protected $hidden = ['created_at','updated_at'];

    public static function selectbox() {
        $list = self::select('name', 'id')->where('status', 1)->get();
        $options = [];
        $options[0] = 'Select Category';
        foreach($list as $item) {
            $options[$item->id] = $item->name;
        }
        return $options;
    }
}
