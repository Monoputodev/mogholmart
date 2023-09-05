<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBillingShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_billing_shipping', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('users_id')->nullable();
            $table->enum('type',array('billing','shipping'))->nullable();
            $table->string('first_name',32)->nullable();
            $table->string('last_name',32)->nullable();
            $table->string('company',32)->nullable();
            $table->string('email',32)->nullable();
            $table->text('address')->nullable();
            $table->integer('country')->nullable(); 
            $table->string('city',16)->nullable(); 
            $table->string('area',64)->nullable(); 
            $table->string('zip',16)->nullable(); 
            $table->string('phone',16)->nullable(); 
            $table->string('fax',16)->nullable(); 
            $table->text('special_instruction')->nullable(); 
            $table->string('alternative_phone',32)->nullable(); 
            
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';
            
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_billing_shipping');
    }
}
