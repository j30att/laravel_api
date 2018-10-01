<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_events', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');

            $table->string('title');

            $table->integer('image_id')->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('image_attachments')->onDelete('set null');

            $table->double('fund');
            $table->double('buy_in');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
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
        Schema::dropIfExists('sub_events');
    }
}
