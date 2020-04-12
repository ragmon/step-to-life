<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fine;
use App\User;
use Faker\Generator as Faker;

$factory->define(Fine::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'description' => $faker->text(32),
        'sum' => $faker->numberBetween(250, 1000),
    ];
});
