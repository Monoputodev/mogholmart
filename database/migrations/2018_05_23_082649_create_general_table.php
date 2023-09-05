<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_pages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title',32)->nullable();
            $table->string('slug',32)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image_link',128)->nullable();
            $table->string('meta_title',32)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image_link',128)->nullable();

            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

             $table->engine= 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_pages');
    }
}
