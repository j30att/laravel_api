<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignForBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_p_bids', function (Blueprint $table) {
            $table->index('pp_bid_id');
        });

        Schema::table('bids', function (Blueprint $table) {

            $table->foreign('p_p_bid_id')
                ->references('pp_bid_id')
                ->on('p_p_bids')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
