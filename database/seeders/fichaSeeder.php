<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class fichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            DB::table('ficha')->insert([
                'nombre' => $faker->name,
                'url' => $faker->url,
                'publicada' => $faker->randomElement($array = array ('true','false')),
            ]);
        }
    }
}
