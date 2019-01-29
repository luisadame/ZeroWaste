<?php

use Illuminate\Database\Seeder;
use App\FoodType;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Breakfast', 'Lunch', 'Dinner', 'Main', 'Drinks', 'Desserts'];
        foreach ($types as $type) {
            $obj = new FoodType();
            $obj->value = $type;
            $obj->save();
        }
    }
}
