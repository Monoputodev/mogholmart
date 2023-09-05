<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->nullable();

            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('thana_id')->nullable();
            $table->string('deliver_day',32)->nullable();
            $table->decimal('deliver_cost',10,4)->nullable();

            $table->string('created_by',30)->nullable();

            $table->string('updated_by',30)->nullable();
            
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
        Schema::dropIfExists('product_shipping');
    }
}
