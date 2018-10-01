<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_attachments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type')->nullable();
            $table->index('type', 'images_type_index');

            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->string('code')->nullable();
            $table->index('code', 'images_code_index');

            $table->string('original_name')->nullable();
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
        Schema::dropIfExists('image_attachments');
    }
}
