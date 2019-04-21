<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(),
        'user_id' => function() {
            return App\User::all()->random()->id;
        },
        'gallery_id' => function() {
            return App\Gallery::all()->random()->id;
        }
    ];
});
