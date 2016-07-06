<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juri', function (Blueprint $table) {
            $table->integer('departamento_id')->unsigned();
            $table->integer('visitante_id')->unsigned();
            $table->foreign('departamento_id')
            ->references('id')
            ->on('departamentos');
            $table->foreign('visitante_id')
            ->references('id')
            ->on('visitantes');
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
        Schema::drop('juri');
    }
}
