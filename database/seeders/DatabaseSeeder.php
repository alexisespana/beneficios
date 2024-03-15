<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosSeeder::class);
        $this->call(fichaSeeder::class);
        $this->call(BeneficiosSeeder::class);
        $this->call(MontosMaximosSeeder::class);
        $this->call(BeneficiosEntregadosSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
