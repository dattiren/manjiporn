<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    if(rand() % 4 == 0){
        return [
            'broad_category_id' => 2,
            'name' => $faker->name
        ];
    }else{
        return [
            'broad_category_id' => 1,
            'name' => $faker->word
        ];
    }
});
