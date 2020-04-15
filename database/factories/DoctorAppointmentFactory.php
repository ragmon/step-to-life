<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DoctorAppointment;
use Faker\Generator as Faker;

$factory->define(DoctorAppointment::class, function (Faker $faker) {
    return [
        'resident_id' => function () {
            return factory(\App\Resident::class)->create()->id;
        },
        'doctor' => "$faker->firstName $faker->lastName",
        'drug' => $faker->text(15),
        'reception_schedule' => $faker->text(100),
    ];
});
