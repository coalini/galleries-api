<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->text($maxNbChars = 200),
        'user_id' => function () {
            return App\User::all()->random()->id;
        },
    ];
});
