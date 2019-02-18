<?php

use Faker\Generator as Faker;

$factory->define(App\Food::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'expiration_date' => now()->addDays(rand(-10, 20))
    ];
});
