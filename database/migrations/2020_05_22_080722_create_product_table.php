<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type',array('simple-product','configurable-product','group-product'))->nullable();
            $table->string('title',128)->nullable();
            $table->string('slug',128)->unique()->nullable();
            $table->string('item_no',64)->unique()->nullable();
            $table->decimal('sell_price',10,4)->nullable();
            $table->decimal('list_price',10,4)->nullable();
            $table->decimal('offer_price',10,4)->nullable();
            $table->decimal('weight',10,4)->nullable();

            $table->unsignedInteger('attribute_set_id')->nullable();
            $table->unsignedInteger('manufacturer_id')->nullable();

            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();

            $table->enum('is_emi',array('yes','no'))->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->unsignedInteger('merchant_id')->nullable();

            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';

            $table->foreign('attribute_set_id')->references('id')->on('attribute_set');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer');
            $table->foreign('merchant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
