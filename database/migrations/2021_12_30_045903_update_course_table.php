<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            $table->string('image')->after('video')->nullable();
        });
        Schema::table('user_logbook', function ($table) {
            $table->string('course_id')->after('user_id')->nullable();
            $table->string('notification_id')->after('course_id')->nullable();
            $table->string('subscription_id')->after('notification_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function ($table) {
            $table->dropColumn('image');
        });
        Schema::table('user_logbook', function ($table) {
            $table->dropColumn('course_id');
            $table->dropColumn('notification_id');
            $table->dropColumn('subscription_id');
        });
    }
}
