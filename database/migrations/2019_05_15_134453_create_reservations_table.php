<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_number');
            $table->string('identitiy_card');
            $table->string('type_identitiy_card');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('email');
            $table->date('date');
            $table->dateTime('checkin_date');
            $table->dateTime('checkout_date');
            $table->string('room_number');
            $table->boolean('extra_bed');
            $table->integer('duration');
            $table->string('adult_guest');
            $table->string('child_guest');
            $table->string('price_day');
            $table->string('total_price');
            $table->string('status');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
