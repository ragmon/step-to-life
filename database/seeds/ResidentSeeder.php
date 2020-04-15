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
            $resident->notes()->saveMany(factory(\App\Note::class, 50)->create());

            factory(\App\DoctorAppointment::class, 5)->create([
                'resident_id' => $resident->id,
            ]);
            factory(\App\ResidentParent::class, 2)->create([
                'resident_id' => $resident->id,
            ]);
        }
    }
}
