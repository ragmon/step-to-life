<?php

use App\Fine;
use App\Punishment;
use App\Report;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)->create();

        foreach ($users as $user) {
            /** @var User $user */

            factory(Punishment::class, 10)->create([
                'user_id' => $user->id,
            ]);
            factory(Fine::class, 10)->create([
                'user_id' => $user->id,
            ]);
            $tasks = factory(Task::class, 10)->create([
                'user_id' => $user->id,
            ]);
            $user->tasks()->saveMany($tasks);
            factory(Report::class, 10)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
