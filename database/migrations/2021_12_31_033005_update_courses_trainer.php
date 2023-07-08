<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCoursesTrainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function ($table) {
            $table->integer('trainer_id')->after('id')->nullable();
            $table->string('total_weeks')->after('daystocompletion')->nullable();
            $table->string('week_a_days')->after('total_weeks')->nullable();
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
            $table->dropColumn('trainer_id');
            $table->dropColumn('total_weeks');
            $table->dropColumn('week_a_days');
        });
    }
}
