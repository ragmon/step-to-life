<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resident;
use Faker\Generator as Faker;

$factory->define(Resident::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'patronymic' => $faker->lastName,
        'gender' => $faker->boolean,
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->date(),
        'registered_at' => $faker->date(),
        'about' => $faker->text,
        'source' => $faker->text(32),
        'balance' => $faker->numberBetween(0, 10000),
    ];
});
