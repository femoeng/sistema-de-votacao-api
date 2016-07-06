<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projecta', function (Blueprint $table) {
            $table->integer('projecto_id')->unsigned();
            $table->integer('projectista_id')->unsigned();
            $table->foreign('projecto_id')
            ->references('id')
            ->on('projectos')
            ->onDelete('cascade');
             $table->foreign('projectista_id')
            ->references('id')
            ->on('projectistas')
            ->onDelete('cascade');
            $table->string('cetagoria_represetante',45);
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
        Schema::drop('projecta');
    }
}
