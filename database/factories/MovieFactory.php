<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => 'Biggest tit girl',
        'thumbnail_url' => $faker->url,
        'url' => $faker->url
    ];
});
