<?php

use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $residents = factory(\App\Resident::class, 20)->create();

        $responsibilities = factory(\App\Responsibility::class, 10)->create();

        foreach ($residents as $resident) {
            /** @var \App\Resident $resident */
            $resident->responsibilities()->saveMany($responsibilities);
            $resident->doctorAppointments()->saveMany(
                factory(\App\DoctorAppointment::class, 5)->create()
            );
        }
    }
}
