<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSVOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_v__orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('recipient_name');
            $table->string('sender_name');
            //$table->string('sender_email');
            //$table->string('day');
            //$table->string('timeslot');
            //$table->string('song_choice');
            //$table->string('comment');

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
        Schema::dropIfExists('s_v__orders');
    }
}
