<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_username') ; 
            $table->string('patient_password') ; 
            $table->string('name') ; 
            $table->string('lastName') ; 
            $table->string('country') ; 
            $table->string('dob') ; 
            $table->integer('cin') ; 
            $table->string('avatar_link') ; 
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
        Schema::dropIfExists('patients');
    }
}
