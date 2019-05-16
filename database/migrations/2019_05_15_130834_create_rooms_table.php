<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_number');
            $table->integer('type');
            $table->string('price_day');
            $table->integer('bed_type');
            $table->integer('guest_total');
            $table->text('description');
            $table->string('is_active');
            $table->integer('fee_breakfast');
            $table->string('is_booking');
            $table->integer('condition');
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
        Schema::dropIfExists('rooms');
    }
}
