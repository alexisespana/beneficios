<?php

namespace Database\Seeders;

use App\Console\Kernel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BeneficiosEntregadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $run = ['10.937.379-6', '12.034.273-8', '12.071.096-6', '12.105.192-3', '12.247.408-9', '12.494.077-K', '12.659.055-5', '13.299.212-6', '13.591.488-6', '13.704.985-6'];
        $faker = Faker::create();
        $usuarios = DB::table('usuarios')->get();
        foreach ($usuarios as $key => $value) {
            $beneficios = DB::table('beneficios')->inRandomOrder()->take($faker->numberBetween($min = 1, $max = 10))->pluck('id'); // buscamos una cantidad aleatoria de beneficio para asignar al run

            foreach ($beneficios as $key => $benef) {
                # code...
                DB::table('beneficios_entregados')->insert([
                    'id_beneficio' => $benef,
                    'run' => $value->run,
                    'dv' => $value->dv,
                    'total' => $faker->numberBetween($min = 0, $max = 300000),
                    'estado' => $faker->numberBetween($min = 0, $max = 1),
                    'fecha' => $faker->date($format = 'Y-m-d', $max = 'now'),
                ]);
            }
        }
    }
}
