<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmssyncMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('smssync_messages', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('from');
            $table->string('sent_to');
            $table->string('device_id');
            $table->tinyInteger("smssync_sent");
            $table->dateTime("timestamp");
            $table->rememberToken();
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
        //
    }
}
