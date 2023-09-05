<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comissions_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id')->unique()->nullable();
            
            $table->float('comission_rate',5,2)->nullable();
            $table->enum('comission_type',array('default','merchantwise','brandwise','productwise'))->nullable();
            $table->string('from_date',32)->nullable();
            $table->string('to_date',32)->nullable();
            $table->text('items')->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();

            $table->string('created_by',30)->nullable();
            $table->string('updated_by',30)->nullable();

            $table->timestamps();

            $table->engine= 'InnoDB';
            
            $table->foreign('merchant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comissions_setting');
    }
}
