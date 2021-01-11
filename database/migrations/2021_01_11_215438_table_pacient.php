<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePacient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacient', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('document', 255);
            $table->string('email', 255);
            $table->enum('gender', ['male', 'female']);
            $table->date('birth');
            $table->enum('blood', ['A+','A-','O+','O-','AB+','AB-','B-','B+']);
            $table->longText('allergy');
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
        Schema::dropIfExists('pacient');
    }
}
