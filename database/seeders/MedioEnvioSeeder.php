<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\MedioEnvio;

class MedioEnvioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedioEnvio::create([
            "medio"         => "Retiro en sucursal",
            "costo"         => NULL,
            "estado"        => 1,
        ]);

        MedioEnvio::create([
            "medio"         => "Envío a domicilio",
            "costo"         => 1250.00,
            "estado"        => 1,
        ]);
    }
}
