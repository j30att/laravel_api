<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsInSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->float('amount_raised')->default(0)->change();
            $table->integer('share_sold')->default(0)->change();
            $table->integer('average_markup')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('amount_raised')->nullable()->change();
            $table->integer('share_sold')->nullable()->change();
            $table->integer('average_markup')->nullable()->change();
        });
    }
}
