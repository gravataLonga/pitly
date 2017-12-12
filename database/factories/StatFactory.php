<?php

use Faker\Generator as Faker;

$factory->define(App\Stat::class, function (Faker $faker) {
    return [
        'shorten_id' => function () {
            return factory(Shorten::class)->create();
        },
        'hit_at' => $faker->dateTimeBetween('-1 year', 'now')
    ];
});
