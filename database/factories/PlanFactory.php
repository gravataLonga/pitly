<?php

use Faker\Generator as Faker;

$factory->define(App\Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'amount' => $faker->numberBetween(100, 5000) // 100 -> 1€
    ];
});
