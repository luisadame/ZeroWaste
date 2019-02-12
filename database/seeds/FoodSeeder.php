<?php

use Illuminate\Database\Seeder;
use App\FoodType;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Food::class, 10)
            ->create()
            ->each(function ($food) {
                $food->types()->attach(
                    FoodType::inRandomOrder()->limit(rand(1, 3))->get()
                );
            });
    }
}
