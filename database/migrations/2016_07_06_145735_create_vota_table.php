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
            $table->string('criterio_id');

            $table->foreign('projecto_id')
                  ->references('id')
                  ->on('projectos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('visitante_id')
                   ->references('id')
                  ->on('visitantes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('criterio_id')
                   ->references('id')
                   ->on('criterios')
                   ->onDelete('cascade')
                   ->onUpdate('cascade');

            $table->unique(['visitante_id', 'projecto_id', 'criterio_id']);
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
