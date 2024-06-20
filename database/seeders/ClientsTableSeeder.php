<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = DB::table('users')->get();

        foreach (range(1, 100) as $index) {
            $randomUser = $faker->randomElement($users);

            DB::table('clients')->insert([
                'number' => Str::random(10),
                'lastname' => $faker->lastName,
                'firstname' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date,
                'inn' => $faker->randomNumber(9, true),
                'name_is_responsible' => $randomUser->fio,
                'status' => 'Не в работе',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
