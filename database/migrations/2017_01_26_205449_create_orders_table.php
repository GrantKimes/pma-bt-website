<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('recipient_name', 255);
            $table->string('sender_name', 255);
            $table->string('sender_email', 255);
            $table->string('day', 255);
            $table->string('location', 255);            
            $table->string('timeslot', 255);
            $table->string('song_choice', 255);
            $table->string('comment', 500);

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
        Schema::dropIfExists('orders');
    }
}
