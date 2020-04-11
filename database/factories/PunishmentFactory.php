<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Punishment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Punishment::class, function (Faker $faker) {
    return [
        'to_resident_id' => function () {
            return factory(Resident::class)->create()->id;
        },
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'description' => $faker->text,
        'start_at' => $faker->boolean ? $faker->date() : null,
        'end_at' => $faker->boolean ? $faker->date() : null,
        'finished_at' => $faker->boolean ? $faker->date() : null,
    ];
});
