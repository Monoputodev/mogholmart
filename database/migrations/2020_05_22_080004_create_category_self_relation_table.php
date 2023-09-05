<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySelfRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_self_relation', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('parent_category_id')->nullable();
            $table->unsignedInteger('child_category_id')->nullable();

            $table->string('created_by',50)->nullable();
            $table->string('updated_by',50)->nullable();
            $table->timestamps();

            $table->engine= 'InnoDB';

            $table->foreign('parent_category_id')->references('id')->on('category');
            $table->foreign('child_category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_self_relation');
    }
}
