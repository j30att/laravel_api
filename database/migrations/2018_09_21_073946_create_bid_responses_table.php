<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');

            $table->integer('bid_id')->unsigned()->nullable();
            $table->foreign('bid_id')->references('id')->on('bids')->onDelete('set null');

            $table->integer('investor_id')->unsigned()->nullable();
            $table->foreign('investor_id')->references('id')->on('users')->onDelete('set null');

            $table->double('value');
            $table->double('income');
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
        Schema::dropIfExists('bid_responses');
    }
}
