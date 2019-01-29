<?php

use Faker\Generator as Faker;
use App\User;
use App\Inventory;

$factory->define(Inventory::class, function (Faker $faker) {
    $admin = User::where('email', 'admin@example.com')->first();
    return [
        'user_id' => $faker->boolean ? factory(User::class)->create()->id : $admin->id,
        'name' => $faker->word,
    ];
});
