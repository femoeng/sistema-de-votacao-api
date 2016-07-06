<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vota', function (Blueprint $table) {
            $table->integer('projecto_id')->unsigned();
            $table->integer('visitante_id')->unsigned();
            $table->integer('criterio_id')->unsigned();
            $table->foreign('projecto_id')
            ->references('id')
            ->on('projectos');
             $table->foreign('visitante_id')
            ->references('id')
            ->on('visitantes');
             $table->foreign('criterio_id')
            ->references('id')
            ->on('criterios');
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
        Schema::drop('vota');
    }
}
