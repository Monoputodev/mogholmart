<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoryDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category_discount', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('category_id',256)->nullable();
            $table->string('sub_category_list',256)->nullable();
            
            $table->decimal('disc_percentage',10,4)->nullable();
            $table->string('start_date',32)->nullable();
            $table->string('end_date',32)->nullable();

            $table->enum('type',array('include','exclude','exclude-cashback'))->nullable();
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
        Schema::dropIfExists('product_category_discount');
    }
}
