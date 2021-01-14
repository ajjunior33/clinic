<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProblems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->longText('diagnostic', 255);
            $table->enum('diagnostic_type', ['entry', 'hospitalization','return','diary','exit']);
            $table->enum('gravity', ['green', 'yellow', 'red']);      
            $table->integer('pacient_id')->unsigned();  
            $table->foreign('pacient_id')
                ->references('id')
                ->on('pacients');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
}
