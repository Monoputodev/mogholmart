<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id')->nullable();
            $table->string('shop_name',128)->nullable();
            $table->string('fathers_name',128)->nullable();
            $table->string('age',32)->nullable();
            $table->string('nid',32)->nullable();
            $table->string('tin_no',64)->nullable();
            $table->text('shop_address')->nullable();
            $table->text('shop_description')->nullable();
            $table->text('shop_agreement')->nullable();
            $table->date('agreement_date')->nullable();
            $table->text('agreement_details')->nullable();

            $table->text('first_contact_person_details')->nullable();
            $table->text('second_contact_person_details')->nullable();

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
        Schema::dropIfExists('merchant_profiles');
    }
}
