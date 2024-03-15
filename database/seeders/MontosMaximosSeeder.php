<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class MontosMaximosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $beneficios =  DB::table('beneficios')->get();
        foreach ($beneficios as $benef) {
            $monto_maximo =  $faker->numberBetween($min = 0, $max = 300000);
            DB::table('montos_maximos')->insert([
                'id_beneficio' => $benef->id,
                'monto_maximo' => $monto_maximo,
                'monto_minimo' => $faker->numberBetween($min = 0, $max = $monto_maximo),
            ]);
        }
    }
}
