<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_estudiante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('curso_id')->unsigned();
            $table->bigInteger('estudiante_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');

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
        Schema::dropIfExists('curso_estudiante');
    }
}
