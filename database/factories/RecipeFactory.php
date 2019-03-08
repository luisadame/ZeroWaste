<?php

use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Recipe;
use App\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

$factory->define(Recipe::class, function (Faker $faker) {
    $admin = User::where('email', 'admin@example.com')->first();
    return [
        'user_id' => $faker->boolean ? factory(User::class)->create()->id : $admin->id,
        'country_code' => DB::table('countries')->inRandomOrder()->first()->code,
        'name' => $faker->word,
        'cooking_time' => $faker->randomNumber(3),
        'content' => $faker->text(),
    ];
});

$factory->state(Recipe::class, 'withImages', function (Faker $faker) {
    $images = [];

    for ($i = 0; $i < rand(1, 9); $i++) {
        $filename = UploadedFile::fake()
            ->image("delicious_omelette{$i}.jpg", 640, 480)
            ->size(200)
            ->store('', 'temporary');

        $images[] = (new Image())->getServerIdFromPath($filename);
    }

    return compact('images');
});
