<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('test_name');
            $table->string('parameter');
            $table->string('result');
            $table->string('filename');
            $table->date('report_date');
            $table->mediumText('note');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('lab_id');
            $table->foreign('lab_id')->references('id')->on('partners')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('reports');
    }
}
