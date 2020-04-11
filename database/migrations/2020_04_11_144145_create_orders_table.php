<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('landmark');
            $table->string('state');
            $table->string('pin');
            $table->string('phone');
            $table->string('email');
            $table->date('pickup_date');
            $table->time('pickupst_time', 0);
            $table->time('pickupend_time', 0);
            // $table->time('pickupend_time', 11);
            $table->string('billamt');
            $table->enum('payment_mode', ['COL','Online']);
            $table->mediumText('pickup_note');
            $table->enum('order_status', ['1', '2','3','4']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });

            Schema::create('order_test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('test_id');
            // $table->string('cost');
            $table->timestamps();

            $table->unique(['order_id','test_id']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        });




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
