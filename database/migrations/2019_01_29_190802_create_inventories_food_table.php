<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories_food', function (Blueprint $table) {
            $table->unsignedInteger('inventory_id');
            $table->unsignedInteger('food_id');
            $table->timestamps();

            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->foreign('food_id')->references('id')->on('food');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories_food');
    }
}
