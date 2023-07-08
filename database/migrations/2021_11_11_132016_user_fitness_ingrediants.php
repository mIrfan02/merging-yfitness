<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserFitnessIngrediants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fitness_ingrediants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('fitness_goal_id');
            $table->integer('height');
            $table->string('heightin')->nullable();
            $table->integer('weight');
            $table->string('weightin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_fitness_ingrediants');
    }
}
