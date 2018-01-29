e<?php

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
            $table->string('location', 255);            
            $table->string('comment', 500)->default('');

            // TODO: should these be nullable, should deleting cascade, should there be default value
            $table->integer('timeslot_id')->unsigned()->nullable();
            $table->foreign('timeslot_id')->references('id')->on('timeslots')->onDelete('set null');

            $table->integer('song_id')->unsigned()->nullable();
            $table->foreign('song_id')->references('id')->on('songs')->onDelete('set null');

            // $table->softDeletes();

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
