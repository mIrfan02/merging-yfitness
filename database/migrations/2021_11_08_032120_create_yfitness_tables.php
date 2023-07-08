<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYfitnessTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->text('video');
            $table->integer('daystocompletion');
            $table->timestamps();
        });
        Schema::create('course_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('course_category_listing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('cat_id');
            $table->timestamps();
        });
        Schema::create('course_user_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('cat_id');
            $table->integer('total_days');
            $table->integer('current_days');
            $table->integer('completion_percentage');
            $table->timestamps();
        });
        Schema::create('user_logbook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('activity');
            $table->text('detail');
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
        Schema::drop('courses');
        Schema::drop('user_logbook');
        Schema::drop('course_category');
        Schema::drop('course_user_progress');
        Schema::drop('course_category_listing');
    }
}
