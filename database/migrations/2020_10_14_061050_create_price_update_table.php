<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_update', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('product_id')->nullable();
            
            $table->decimal('actual_price',10,4)->nullable();
            $table->decimal('update_price',10,4)->nullable();
            $table->decimal('actual_list_price',10,4)->nullable();
            $table->decimal('list_update_price',10,4)->nullable();
            
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
        Schema::dropIfExists('price_update');
    }
}
