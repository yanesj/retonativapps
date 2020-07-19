<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursoHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_horario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('curso_id')->unsigned();
            $table->bigInteger('horario_id')->unsigned();
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('horario_id')->references('id')->on('horarios');
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
        Schema::dropIfExists('curso_horario');
    }
}
