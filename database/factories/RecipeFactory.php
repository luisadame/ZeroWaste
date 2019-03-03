<?php

use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Recipe;

$factory->define(Recipe::class, function (Faker $faker) {
    $admin = User::where('email', 'admin@example.com')->first();
    return [
        'user_id' => $faker->boolean ? factory(User::class)->create()->id : $admin->id,
        'type_id' => DB::table('food_types')->inRandomOrder()->first()->id,
        'country_code' => DB::table('countries')->inRandomOrder()->first()->code,
        'name' => $faker->word,
        'cooking_time' => $faker->randomNumber(3),
        'content' => $faker->text(),
    ];
});
