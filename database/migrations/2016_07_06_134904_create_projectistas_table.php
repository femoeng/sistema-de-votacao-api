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
            $table->string('numero_estudante')->nullable();
            $table->string('apelido');
            $table->string('nome');
            $table->integer('numero_celular')->unsigned();
            $table->integer('curso_id')->unsigned()->nullable();
            $table->foreign('curso_id')->
            references('id')->
            on('cursos')->onDelete('cascade')->onUpdate('cascade');
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
