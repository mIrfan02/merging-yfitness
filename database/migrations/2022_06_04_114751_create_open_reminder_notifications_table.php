<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenReminderNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_reminder_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('day')->nullable();
            $table->text('notification_text')->nullable();
            $table->integer('duration')->nullable();
            $table->string('term')->nullable();
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('open_reminder_notifications');
    }
}
