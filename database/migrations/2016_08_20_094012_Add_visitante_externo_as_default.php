<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitanteExternoAsDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitantes', function (Blueprint $table) {
            $table->enum('tipo_visitante',['interno','externo'])->default('interno')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visitantes', function (Blueprint $table) {

            
        });
    }
}
