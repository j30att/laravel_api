<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePPRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_p_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('bid_id')->nullable();
            $table->foreign('bid_id')
                ->references('id')
                ->on('bids')
                ->onDelete('set null');

            $table->tinyInteger('transaction_type')->nullable();
            $table->double('amount')->nullable();
            $table->text('headers')->nullable();
            $table->text('body')->nullable();

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
        Schema::dropIfExists('p_p_requests');
    }
}
