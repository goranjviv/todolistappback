<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Todo;
use App\User;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userIds = User::all()->pluck('id')->toArray();

        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Todo::create([
                'user_id' => $faker->randomElement($userIds),
                'title' => $faker->sentence,
                'text' => $faker->text,
                'priority' => $faker->randomElement([1, 2, 3]),
                'done' => $faker->boolean,
            ]);
        }
    }
}
