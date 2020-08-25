<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadsintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedadsintomas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('enfermedad_id');
            $table->foreign('enfermedad_id')->references('id')->on('enfermedads');


            $table->unsignedBigInteger('sintoma_id');
            $table->foreign('sintoma_id')->references('id')->on('sintomas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfermedadsintomas');
    }
}
