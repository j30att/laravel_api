<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('country_id')->nullable()->unsigned();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->double('buy_in')->nullable();
            $table->double('reg_free')->nullable();
            $table->double('fund')->nullable();
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();
            $table->string('currency')->nullable();
            $table->integer('venue_id')->nullable();
            $table->string('venue_name')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
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
        Schema::dropIfExists('events');
    }
}
