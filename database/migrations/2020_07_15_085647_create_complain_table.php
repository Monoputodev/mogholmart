<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complain_us', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject',128)->nullable();
            $table->string('email',128)->nullable();
            $table->string('phone',15)->nullable();
            $table->text('complain')->nullable();
            
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
        Schema::dropIfExists('complain_us');
    }
}
