<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTransectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('order_head_id')->nullable();
            $table->string('transaction_number',32)->nullable();
            $table->date('date')->nullable();
            $table->decimal('amount',10,4)->nullable();
            $table->string('ssl_id',32)->nullable();
            $table->text('hash_key')->nullable();

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
        Schema::dropIfExists('order_transection');
    }
}
