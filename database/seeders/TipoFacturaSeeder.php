<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoFactura;

class TipoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoFactura::create([
            "tipo"          => "A",
            "descripcion"   => "De responsable inscripto a responsable inscripto o monotributista"
        ]);

        TipoFactura::create([
            "tipo"          => "B",
            "descripcion"   => "De responsable inscripto a consumidor final o exento en el IVA"
        ]);

        TipoFactura::create([
            "tipo"          => "C",
            "descripcion"   => "De monotributista o exento en el IVA a todo destinatario"
        ]);

        TipoFactura::create([
            "tipo"          => "M",
            "descripcion"   => "De responsable inscripto a responsable inscripto"
        ]);

        TipoFactura::create([
            "tipo"          => "E",
            "descripcion"   => "De exportador a sujeto del exterior"
        ]);

        TipoFactura::create([
            "tipo"          => "T",
            "descripcion"   => "De hotel o servicio de alojamiento a turistas extranjeros"
        ]);
    }
}
