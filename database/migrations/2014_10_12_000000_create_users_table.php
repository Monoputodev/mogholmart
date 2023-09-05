<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
        
            $table->string('email',64)->unique()->nullable();
            $table->string('password',64)->nullable();
            $table->string('first_name',64)->nullable();
            $table->string('last_name',64)->nullable();
            $table->string('mobile_no',15)->nullable();
            $table->string('nid',64)->nullable();
            $table->string('image',128)->nullable();

            $table->unsignedInteger('roles_id')->nullable();

            $table->enum('type',array('admin','customer','seller'))->nullable();
            $table->enum('merchant_agreement',array('no','yes'))->nullable();
            $table->decimal('cash_back',10,4)->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('otp',10)->nullable();
            $table->string('otp_password',255)->nullable();
            $table->string('remember_token',255)->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';


            if(Schema::hasTable('roles')){

                $table->foreign('roles_id')->references('id')->on('roles');

            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
