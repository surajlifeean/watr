<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cost');
            $table->timestamps();
        });

        Schema::create('parameter_test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parameter_id');
            $table->unsignedBigInteger('test_id');
            $table->timestamps();

            $table->unique(['test_id','parameter_id']);

            $table->foreign('parameter_id')->references('id')->on('parameters')->onDelete('cascade');
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
        Schema::dropIfExists('parameters');
    }
}
