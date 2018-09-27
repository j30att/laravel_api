<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubeventIdFieldToBidResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bid_responses', function (Blueprint $table) {
            $table->integer('subevent_id')->unsigned()->nullable();
            $table->foreign('subevent_id')->references('id')->on('sub_events')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bid_response', function (Blueprint $table) {
            $table->dropForeign('bid_responses_subevent_id_foreign');
            $table->dropColumn('subevent_id');
        });
    }
}
