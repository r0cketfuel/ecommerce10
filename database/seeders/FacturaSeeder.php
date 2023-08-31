<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Factura;

class FacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Factura::create([
            "numero"            => 1,
            "fecha"             => "2022-12-28",
            "tipo_factura_id"   => 1,
            "apellidos"         => "Apellido",
            "nombres"           => "Nombres",
            "tipo_documento_id" => 1,
            "nro_documento"     => "12345678",
            "cuil"              => "20123456782",
            "cuit"              => "",
            "domicilio"         => "Domicilio",
            "domicilio_nro"     => "1234",
            "domicilio_piso"    => "PB",
            "domicilio_depto"   => "4",
            "localidad"         => "Bahía Blanca",
            "codigo_postal"     => "8000",
            "total"             => "1234.56",
            "medio_pago_id"     => 1,
            "cae"               => "01234567890123",
            "cae_vto"           => "2025-01-01",
            "estado_id"         => 1,
        ]);
    }
}
