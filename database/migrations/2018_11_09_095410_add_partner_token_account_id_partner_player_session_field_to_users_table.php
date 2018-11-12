<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPartnerTokenAccountIdPartnerPlayerSessionFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pp_partner_token')->nullable();
            $table->string('pp_account_id')->nullable();
            $table->string('pp_partner_player_session')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pp_partner_token');
            $table->dropColumn('pp_account_id');
            $table->dropColumn('pp_partner_player_session');
        });
    }
}
