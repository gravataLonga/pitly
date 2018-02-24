<?php

use Faker\Generator as Faker;

$factory->define(App\Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'key' => 'main',
        'amount' => $faker->numberBetween(100, 5000) // 100 -> 1€
    ];
});
