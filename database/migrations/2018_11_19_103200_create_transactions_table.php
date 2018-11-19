<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pp_bid_id')->nullable();
            $table->foreign('pp_bid_id')
                ->references('id')
                ->on('p_p_bids')
                ->onDelete('set null');

            $table->unsignedInteger('bid_id')->nullable();
            $table->foreign('bid_id')
                ->references('id')
                ->on('bids')
                ->onDelete('set null');

            $table->unsignedInteger('sale_id')->nullable();
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales')
                ->onDelete('set null');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->double('amount')->nullable();
            $table->tinyInteger('type');
            $table->tinyInteger('status')->default(1);

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
        Schema::dropIfExists('transactions');
    }
}
