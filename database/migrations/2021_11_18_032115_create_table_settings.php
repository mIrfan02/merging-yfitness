<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('receive_notifications')->default(0);
            $table->tinyinteger('receive_newsletter')->default(0);
            $table->tinyinteger('receive_special_offer')->default(0);
            $table->timestamps();
        });
        Schema::create('user_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('distance_covered');
            $table->string('calaries_gain');
            $table->string('time_spand');
            $table->dateTime('record_date');
            $table->timestamps();
        });
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('meta_key');
            $table->string('meta_value');
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
        Schema::drop('user_notifications');
        Schema::drop('user_statistics');
        Schema::drop('user_settings');
    }
}
