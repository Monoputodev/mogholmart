<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_head', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('users_id')->nullable();
            $table->string('order_number',32)->nullable();
            $table->date('date')->nullable();
            $table->integer('vat_rate')->nullable();
            $table->decimal('vat_amount',10,4)->nullable();
            $table->string('coupon_code',32)->nullable();
            $table->integer('coupon_code_rate')->nullable();
            $table->decimal('coupon_code_value',10,4)->nullable();
            $table->decimal('shipping_value',10,4)->nullable();
            $table->string('shipping_method')->nullable();
            $table->decimal('sub_total_price',10,4)->nullable();
            $table->decimal('total_price',10,4)->nullable();
            $table->string('payment_type',16)->nullable();
            $table->string('courier_name',64)->nullable();
            $table->string('courier_package',64)->nullable();
            $table->text('note')->nullable();

            $table->enum('status',array('pending','confirmed','processing','on_transit','delivered','delivery_failed','returned','failed','cancel'))->nullable();
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
        Schema::dropIfExists('order_head');
    }
}
