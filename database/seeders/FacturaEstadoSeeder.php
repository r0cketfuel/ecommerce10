<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FacturaEstado;

class FacturaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacturaEstado::create([
            "estado" => "Pagada"
        ]);
        
        FacturaEstado::create([
            "estado" => "Pendiente de pago"
        ]);

        FacturaEstado::create([
            "estado" => "Anulada"
        ]);
    }
}
