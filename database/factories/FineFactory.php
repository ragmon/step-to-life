<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fine;
use Faker\Generator as Faker;

$factory->define(Fine::class, function (Faker $faker) {
    return [
        'description' => $faker->text(32),
        'sum' => $faker->numberBetween(250, 1000),
    ];
});
