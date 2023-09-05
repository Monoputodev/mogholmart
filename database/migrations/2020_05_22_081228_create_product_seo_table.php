<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_seo', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_id')->nullable();

            $table->string('meta_title',32)->nullable();
            $table->string('meta_keywords',128)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image_link',128)->nullable();

            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';
            
            $table->foreign('product_id')->references('id')->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_seo');
    }
}
