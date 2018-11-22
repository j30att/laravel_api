<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('event_id')->nullable();
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('set null');

            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('set null');

            $table->string('title')->nullable();
            $table->string('adress_type')->nullable();
            $table->string('street')->nullable();
            $table->string('locality')->nullable();
            $table->unsignedInteger('postal_code')->nullable();
            $table->string('address_region')->nullable();
            $table->text('venue_address')->nullable();
            $table->float('venue_longitude')->nullable();
            $table->float('venue_latitude')->nullable();
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
        Schema::dropIfExists('venues');
    }
}
