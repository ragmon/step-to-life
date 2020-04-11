<?php

use App\Punishment;
use Illuminate\Database\Seeder;

class PunishmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Punishment::class, 100)->create();
    }
}
