<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id');

            $table->string('coupon_name',32)->nullable();
            $table->text('description')->nullable();
            $table->string('coupon_code',32)->nullable();
            $table->string('coupon_type',32)->nullable();
            $table->integer('user_per_customer')->nullable();
            $table->integer('user_per_coupon')->nullable();
            $table->string('valid_from',32)->nullable();
            $table->string('valid_to',32)->nullable();
            $table->decimal('amount',10,4)->nullable();

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
        Schema::dropIfExists('coupon');
    }
}
