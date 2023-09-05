<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_activities', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ip_address',32)->nullable();
            $table->string('actionname',32)->nullable();
            $table->string('action_url',32)->nullable();
            $table->string('action_table',32)->nullable();
            $table->text('action_details')->nullable();
            $table->unsignedInteger('users_id')->nullable();
            $table->date('date')->nullable();
            
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
        Schema::dropIfExists('users_activites');
    }
}
