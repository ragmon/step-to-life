<?php

use App\Responsibility;
use Illuminate\Database\Seeder;

class ResponsibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Responsibility::class, 10)->create();
    }
}
