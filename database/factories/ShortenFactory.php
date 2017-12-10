<?php

use Faker\Generator as Faker;

$factory->define(App\Shorten::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'token' => str_random(6)
    ];
});
