<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        foreach (range(1, 10) as $benef) {
            DB::table('usuarios')->insert([
                'nombres' => $faker->firstName,
                'apellidos' => $faker->firstName,
                'run' => $faker->ean8,
                'dv' => $faker->randomDigit,
            ]);
        }
    }
}
