<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_assistants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phoneno');
            $table->string('email');
            $table->string('contact_person');
            $table->string('panno');
            $table->enum('status', ['N', 'A']);
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
        Schema::dropIfExists('partner_assistants');
    }
}
