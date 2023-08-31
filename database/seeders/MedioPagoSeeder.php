<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\MedioPago;

class MedioPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedioPago::create([
            "medio"         => "Efectivo",
            "estado"        => 1,
        ]);

        MedioPago::create([
            "medio"         => "Transferencia bancaria",
            "estado"        => 1,
        ]);

        MedioPago::create([
            "medio"         => "Tarjeta de crédito o débito",
            "estado"        => 1,
        ]);

        MedioPago::create([
            "medio"         => "PagoFácil",
            "estado"        => 1,
        ]);

        MedioPago::create([
            "medio"         => "RapiPago",
            "estado"        => 1,
        ]);
    }
}
