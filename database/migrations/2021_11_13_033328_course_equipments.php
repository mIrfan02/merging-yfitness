<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseEquipments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyinteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('course_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_id');
            $table->string('equipment_id');
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
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('course_equipments');
    }
}
