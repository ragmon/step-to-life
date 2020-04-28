<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobDescription;
use Faker\Generator as Faker;

$factory->define(JobDescription::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'content' => $faker->realText(1000),
    ];
});
