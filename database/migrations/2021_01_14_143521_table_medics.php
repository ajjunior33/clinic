<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableMedics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medics', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('crm', 30);
            $table->string('function', 255);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('problems', function (Blueprint $table) {
            $table->integer('medic_id')->unsigned();
            $table->foreign('medic_id')
                ->references('id')
                ->on('medics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medics');
    }
}
