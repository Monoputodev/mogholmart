<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('manufacturer_id')->nullable();

            $table->string('title',32)->nullable();
            $table->string('slug',32)->unique()->nullable();
            $table->string('image_link',128)->nullable();
            $table->string('is_top_brand',32)->nullable();
            $table->string('meta_title',32)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image_link',128)->nullable();

            $table->enum('status',array('active','inactive','cancel'))->nullable();

            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';

            $table->foreign('manufacturer_id')->references('id')->on('manufacturer');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand');
    }
}
