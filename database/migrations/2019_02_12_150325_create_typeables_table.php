<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeables', function (Blueprint $table) {
            $table->unsignedInteger('food_type_id');
            $table->unsignedInteger('typeable_id');
            $table->string('typeable_type');

            $table->foreign('food_type_id')->references('id')->on('food_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typeables');
    }
}
