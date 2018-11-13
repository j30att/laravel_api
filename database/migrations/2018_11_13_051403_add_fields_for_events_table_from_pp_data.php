<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForEventsTableFromPpData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table){
            $table -> string('event_time_zone')->nullable();
            $table -> string('event_venue_address_str')->nullable();
            $table -> timestamp('first_live_day')->nullable();
            $table -> timestamp('last_live_day')->nullable();
            $table -> timestamp('first_day_date')->nullable();
            $table -> timestamp('last_day_date')->nullable();
            $table -> timestamp('start_date_time')->nullable();
            $table -> timestamp('late_reg')->nullable();
            $table -> timestamp('time_zone')->nullable();
            $table -> string('currency')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table){
            $table -> dropColumn('event_time_zone');
            $table -> dropColumn('event_venue_address_str');
            $table -> dropColumn('first_live_day');
            $table -> dropColumn('last_live_day');
            $table -> dropColumn('first_day_date');
            $table -> dropColumn('last_day_date');
            $table -> dropColumn('start_date_time');
            $table -> dropColumn('late_reg');
            $table -> dropColumn('time_zone');
            $table -> dropColumn('currency');
        });
    }
}
