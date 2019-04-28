<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiberecReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liberec_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->boolean('h_7');
            $table->boolean('h_8');
            $table->boolean('h_9');
            $table->boolean('h_10');
            $table->boolean('h_11');
            $table->boolean('h_12');
            $table->boolean('h_13');
            $table->boolean('h_14');
            $table->boolean('h_15');
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
        Schema::dropIfExists('liberec_reservations');
    }
}
