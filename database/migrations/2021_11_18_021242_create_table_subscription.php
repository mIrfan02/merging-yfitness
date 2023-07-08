<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->double('per_month_fee',11,2)->nullable();
            $table->double('total_fee',11,2)->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });
        Schema::create('user_subscriptions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->double('per_month_fee',11,2);
            $table->double('total_fee',11,2);
            $table->string('fee_charge')->default(0);
            $table->text('payment_id');
            $table->date('payment_date');
            $table->timestamps();
        });
        Schema::table('users', function ($table) {
            $table->integer('subscription_plan_id')->after('register_via')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_subscriptions');
        Schema::drop('subscriptions');
    }
}
