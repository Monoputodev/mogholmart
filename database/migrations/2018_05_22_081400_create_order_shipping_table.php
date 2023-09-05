<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_head_id');

            $table->enum('type',array('billing','shipping'))->nullable();
            $table->string('first_name',32)->nullable(); 
            $table->string('last_name',32)->nullable(); 
            $table->string('compnay_name',32)->nullable(); 
            $table->string('email',32)->nullable(); 
            $table->text('address')->nullable(); 
            $table->integer('contry')->nullable(); 
            $table->string('city',16)->nullable(); 
            $table->string('area',64)->nullable(); 
            $table->string('zip',16)->nullable(); 
            $table->string('phone',16)->nullable(); 
            $table->string('fax',16)->nullable(); 

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
        Schema::dropIfExists('order_shipping');
    }
}
