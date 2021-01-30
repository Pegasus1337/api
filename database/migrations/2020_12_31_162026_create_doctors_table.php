<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_username') ; 
            $table->string('doctor_password') ; 
            $table->string('name') ; 
            $table->string('lastName')  ; 
            $table->string('dob') ; 
            $table->string('country') ; 
            $table->integer('matriculation') ;
            $table->string('specialty') ; 
            $table->string('avatar_link') ; 
            $table->integer('RIB') ; 
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
        Schema::dropIfExists('doctors');
    }
}
