<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserCourseSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('course_id');
            $table->tinyinteger('sun')->nullable();
            $table->tinyinteger('mon')->nullable();
            $table->tinyinteger('tue')->nullable();
            $table->tinyinteger('wed')->nullable();
            $table->tinyinteger('thu')->nullable();
            $table->tinyinteger('fri')->nullable();
            $table->tinyinteger('sat')->nullable();
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
        Schema::dropIfExists('user_course_schedule');
    }
}
