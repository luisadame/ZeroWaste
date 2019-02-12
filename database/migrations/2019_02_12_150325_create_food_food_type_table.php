<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodFoodTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_food_type', function (Blueprint $table) {
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('food_type_id');
            $table->foreign('food_id')->references('id')->on('food');
            $table->foreign('food_type_id')->references('id')->on('food_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_food_type');
    }
}
