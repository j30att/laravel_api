<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarAndImageIdFildeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

           $table ->integer('image_id')->unsigned()->nullable();
           $table ->foreign('image_id')->references('id')->on('image_attachments')->onDelete('set null');

           $table -> string('avatar')->nullable();


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

            $table ->dropForeign('users_image_id_foreign');
            $table ->dropColumn('image_id');
            $table -> dropColumn('avatar');


        });
    }
}
