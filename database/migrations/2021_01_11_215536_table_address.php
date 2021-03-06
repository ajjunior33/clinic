<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('address',255);
            $table->string('city', 255);
            $table->string('neighborhood', 255);
            $table->string('state', 2);
            $table->string('zip_code', 30);
            $table->string('number');
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
        Schema::dropIfExists('address');
    }
}
