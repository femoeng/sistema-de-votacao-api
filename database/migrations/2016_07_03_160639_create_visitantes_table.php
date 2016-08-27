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
            $table->string('nome',100);
            $table->enum('tipo_documento',['BI','passaporte','DIRE']);
            $table->string('numero_documento',128)->unique();
            $table->string('contacto')->unique();
            $table->string('email',128)->nullable();
            $table->enum('tipo_visitante',['externo','interno']);
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
