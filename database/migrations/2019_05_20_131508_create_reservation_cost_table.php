<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reservation_number')->nullable();
            $table->integer('base_price')->nullable();           
            $table->integer('total_price')->nullable();   
            $table->integer('service_tip')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('total_room_paid')->nullable();
            $table->integer('deposit')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('reservation_cost');
    }
}
