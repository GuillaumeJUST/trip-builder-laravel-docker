<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->unsignedBigInteger('airline_id');
            $table->unsignedBigInteger('departure_airport_id');
            $table->time('departure_time');
            $table->unsignedBigInteger('arrival_airport_id');
            $table->time('arrival_time');
            $table->double('price');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('departure_airport_id')->references('id')->on('airports');
            $table->foreign('arrival_airport_id')->references('id')->on('airports');
            $table->foreign('airline_id')->references('id')->on('airlines');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
