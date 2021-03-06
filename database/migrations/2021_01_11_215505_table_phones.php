<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['cell_phone', 'fixed']);
            $table->string('owner', 255);
            $table->string('number', 30);
            $table->string('prefixed',3);
            $table->boolean('main');            
            $table->integer('pacient_id')->unsigned();
            $table->foreign('pacient_id')
                ->references('id')
                ->on('pacients')
                ->onDelete('cascade');
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
        Schema::dropIfExists('phones');
    }
}
