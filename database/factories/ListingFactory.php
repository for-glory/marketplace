<?php

use Faker\Generator as Faker;

$factory->define(App\Listing::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'price' => $faker->numberBetween(1000, 20000)
    ];
});

$factory->define(App\ListingImage::class, function (Faker $faker) {
    return [
        'filename' => 'listingimages/bI1vIA4ULgVB4PlJ4lnx1BljEBT5kkXfLWlKulxV.jpeg',
    ];
});