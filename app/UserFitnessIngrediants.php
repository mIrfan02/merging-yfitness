<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFitnessIngrediants extends Model
{
    protected $table = 'user_fitness_ingrediants';

    protected $fillable = ['id','user_id','fitness_goal_id','height','heightin','weight','weightin'];

    protected $hidden = ['created_at','updated_at'];

    protected $appends = ['FitnessGoal'];

    public function getFitnessGoalAttribute() {

        return FitnessGoals::select('name')->where('id',$this->fitness_goal_id)->first();

    }
}
