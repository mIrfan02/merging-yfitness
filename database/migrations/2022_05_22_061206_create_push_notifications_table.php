<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gender')->nullable();
            $table->string('language')->nullable();
            $table->string('age_range')->nullable();
            $table->integer('fitness_goal_id')->nullable();
            $table->timestamp('date')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('link')->nullable();
            $table->text('notification_text')->nullable();
            $table->integer('is_sent')->default(0);
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
        Schema::dropIfExists('push_notifications');
    }
}
