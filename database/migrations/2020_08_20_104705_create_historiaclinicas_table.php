<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriaclinicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historiaclinicas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');


            $table->unsignedBigInteger('enfermedad_id')->nullable();
            $table->foreign('enfermedad_id')->references('id')->on('enfermedads');


            
            $table->text('motivo')->nullable();
            $table->text('antecedentes_personales')->nullable();
            $table->text('antecedentes_familiares')->nullable();
            $table->string('presion_arterial')->nullable();
            $table->string('presion_cardiaca')->nullable();
            $table->string('frecuencia_respiratoria')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('talla')->nullable();


            $table->text('receta')->nullable();
            $table->text('tratamiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historiaclinicas');
    }
}
