<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileldsForCalculateRausedAndSoldAndAvmarkupForSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table){
            $table -> integer('amount_raised')->nullable();
            $table -> integer('share_sold')->nullable();
            $table -> integer('average_markup')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table){
            $table -> dropColumn('amount_raised');
            $table -> dropColumn('share_sold');
            $table -> dropColumn('average_markup');
        });
    }
}
