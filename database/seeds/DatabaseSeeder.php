<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUserSeeder::class,
            CountriesSeeder::class,
            FoodTypeSeeder::class,
            InventoriesSeeder::class,
            FoodSeeder::class,
            RecipesSeeder::class
        ]);
    }
}
