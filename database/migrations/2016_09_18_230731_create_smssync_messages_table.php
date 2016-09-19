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
            $table->string('smssync_to');
            $table->string('smssync_from');
            $table->string('smssync_message_text');
            $table->tinyInteger("smssync_sent");
            $table->dateTime("smssync_sent_date");
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
