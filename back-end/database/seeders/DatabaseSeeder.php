<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            DB::table('users')->insert([
                'nama' => $faker->name,
                'username' => $faker->username,
                'password' => $faker->password,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'idRole' => 1,
                'status' => 1,
            ]);
        }

        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            DB::table('kurir')->insert([
                'nama' => $faker->name,
                'username' => $faker->username,
                'password' => $faker->password,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'tanggalLahir' => $faker->date,
                'gender' => $faker->numberBetween(1, 0),
                'nik' => $faker->nik,
                'idRole' => 1,
                'status' => 1,
            ]);
        }
    }
}
