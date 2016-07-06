<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectistas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apelido',15);
            $table->string('nome',50);
            $table->integer('numero_celular')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->foreign('curso_id')->
            references('id')->
            on('cursos');
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
        Schema::drop('projectistas');
    }
}
