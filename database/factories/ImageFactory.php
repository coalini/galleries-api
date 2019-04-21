<?php

use Faker\Generator as Faker;


$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'url' => $faker->imageUrl($width = 640, $height = 480, 'technics'),
        'gallery_id' => function() {
            return App\Gallery::all()->random()->id;
        }
    ];
});
