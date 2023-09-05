<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_head_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('product_merchant_id')->nullable();
            
            $table->integer('quantity')->nullable();
            $table->decimal('price',10,4)->nullable();
            $table->decimal('total_price',10,4)->nullable();
            $table->decimal('comission_price',10,4)->nullable();
            $table->decimal('cash_back',10,4)->nullable();
            
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';
            
            $table->foreign('order_head_id')->references('id')->on('order_head');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
