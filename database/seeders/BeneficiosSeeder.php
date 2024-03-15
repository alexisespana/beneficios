<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BeneficiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $ficha =  DB::table('ficha')->get();
        foreach ($ficha as $key => $value) {
            DB::table('beneficios')->insert([
                'nombre' => 'Beneficio '.($key+1),
                'id_ficha' => $value->id,
                'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }
    }
}
