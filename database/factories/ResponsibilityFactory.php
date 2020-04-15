<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Responsibility;
use Faker\Generator as Faker;

$factory->define(Responsibility::class, function (Faker $faker) {
    return [
        'name' => $faker->text(15),
        'about' => $faker->text,
    ];
});
