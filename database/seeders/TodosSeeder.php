<?php

namespace Database\Seeders;

use App\Models\Todos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            Todos::create([
                'task' => $faker->sentence(),
                'completed' => $faker->boolean()
            ]);
        }
    }
}
