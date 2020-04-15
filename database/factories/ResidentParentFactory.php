<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ResidentParent;
use Faker\Generator as Faker;

$factory->define(ResidentParent::class, function (Faker $faker) {
    return [
        'resident_id' => function () {
            return factory(\App\Resident::class)->create()->id;
        },
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'patronimyc' => $faker->firstName,
        'gender' => $faker->boolean,
        'role' => $faker->randomElement(['бабушка', 'дедушка', 'мама', 'отец', 'сестра', 'брат']),
        'birthday' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'about' => $faker->realText(),
    ];
});
