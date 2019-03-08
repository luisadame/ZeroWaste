<?php

use Illuminate\Database\Seeder;
use App\Recipe;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recipe::class, 20)->create()
            ->each(function ($recipe) {
                $type_ids = DB::table('food_types')
                    ->inRandomOrder()
                    ->limit(rand(1, 4))
                    ->select('id')->get()
                    ->pluck('id');
                $recipe->types()->attach($type_ids);
            });
    }
}
