<?php

use Faker\Generator as Faker;

$factory->define(App\FoodType::class, function (Faker $faker) {
    return [
        'value' => $faker->word
    ];
});
