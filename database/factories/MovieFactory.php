<?php

use Faker\Generator as Faker;

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => 'Big tit girl',
        'url' => $faker->url
    ];
});
