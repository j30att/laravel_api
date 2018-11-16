<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePPResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_p_responses', function (Blueprint $table) {
            $table->unsignedInteger('p_p_request')->nullable();
            $table->foreign('p_p_request')
                ->references('id')
                ->on('p_p_requests')
                ->onDelete('set null');

            $table->string('status')->nullable();
            $table->integer('error_code')->nullable();
            $table->string('error_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
