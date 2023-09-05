<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code_column',32)->unique()->nullable();
            $table->enum('type',array('text','textarea','checkbox'))->nullable();
            $table->string('type_is_required',16)->nullable();
            $table->integer('order')->nullable();
            $table->string('backend_title',32)->nullable();
            $table->string('frontend_title',32)->nullable();
            $table->string('default_value',16)->nullable();
            $table->string('use_in_quick_search',16)->nullable();
            $table->string('use_in_advance_search',16)->nullable();
            $table->string('use_in_filter',16)->nullable();

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
        Schema::dropIfExists('attribute');
    }
}
