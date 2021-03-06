<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use App\User;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'title' => $faker->text(32),
        'content' => $faker->realText(1000),
    ];
});
