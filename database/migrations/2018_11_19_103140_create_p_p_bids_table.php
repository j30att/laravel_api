<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePPBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'p_p_bids',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('pp_bid_id')->nullable();

                $table->unsignedInteger('sale_id')->nullable();
                $table->foreign('sale_id')
                    ->references('id')
                    ->on('sales')
                    ->onDelete('set null');


                $table->tinyInteger('status')->default(1);
                $table->double('amount')->nullable();

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'bids',
            function (Blueprint $table) {
                $table->dropForeign('bids_p_p_bid_id_foreign');
            }
        );

        Schema::dropIfExists('p_p_bids');
    }
}
