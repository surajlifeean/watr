<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('labname');
            $table->string('contactperson');
            $table->string('number');
            $table->string('designation');
            $table->string('panfile');
            $table->string('panno');
            $table->string('gstno');
            $table->string('gstfile');
            $table->string('chequefile');
            // $table->string('yoe')->nullable(); 
            $table->enum('status', ['A', 'I']);
            $table->timestamps();
        });
        
        Schema::create('partner_test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('test_id');
            $table->string('cost');
            $table->timestamps();

            $table->unique(['test_id','partner_id']);

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
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
        Schema::dropIfExists('partners');
    }
}
