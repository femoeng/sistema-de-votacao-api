<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',6);
            $table->string('tipDoc',100);
            $table->string('numero_documento',5);
            $table->string('contacto',9);
            $table->string('email','45');
            $table->string('tipo_visitante','45');
            $table->string('pin');
            $table->boolean('votou')->default(false);
            
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
        Schema::drop('visitantes');
    }
}
