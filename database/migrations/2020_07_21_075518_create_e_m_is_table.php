<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEMIsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('emi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_name',128)->nullable();
            $table->string('emi_month',32)->nullable();
            $table->decimal('emi_rate',10,4)->nullable();
            $table->decimal('emi_interest_rate',10,4)->nullable();
            $table->enum('status',array('active','inactive','cancel'))->nullable();
            $table->string('created_by',30)->nullable();
            $table->string('updated_by',30)->nullable();
            
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
        Schema::dropIfExists('emi');
    }
}
