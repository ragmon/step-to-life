<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'title' => $faker->text(32),
        'description' => $faker->text,
        'start_at' => $faker->date(),
        'end_at' => $faker->date(),
        'finished_at' => $faker->boolean ? $faker->date() : null,
    ];
});
