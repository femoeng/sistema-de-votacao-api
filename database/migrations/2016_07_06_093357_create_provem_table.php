<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provem', function (Blueprint $table) {
            $table->integer('curso_id')->unsigned();
            $table->integer('projecto_id')->unsigned();
            $table->foreign('curso_id')->
            references('id')->
            on('cursos')->
            onDelete('cascade');
            $table->foreign('projecto_id')->
            references('id')->
            on('projectos')->
            onDelete('cascade');
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
        Schema::drop('provem');
    }
}
