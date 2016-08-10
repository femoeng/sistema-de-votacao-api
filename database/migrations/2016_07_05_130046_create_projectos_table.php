<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',100);
            $table->string('area_aplicacao',120);
            $table->string('descricao',120)->nullable();
            $table->string('imagem',120)->nullable();
            $table->string('tutor',45)->nullable();
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
        Schema::drop('projectos');
    }
}
