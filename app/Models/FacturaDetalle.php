<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = "facturas_detalles";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "factura_id",
        "articulo_id",
        "codigo",
        "nombre",
        "descripcion",
        "opciones",
        "precio",
        "moneda",
        "cantidad",
        "subtotal",
        "medio_envio_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function generarDetalle(array $parametros): FacturaDetalle
    {
        //===============================================//
        // Método que genera un nuevo detalle de factura //
        //===============================================//

        $detalle = self::create([
            "factura_id"        => $parametros["factura_id"],
            "articulo_id"       => $parametros["articulo_id"],
            "codigo"            => $parametros["codigo"],
            "nombre"            => $parametros["nombre"],
            "descripcion"       => $parametros["descripcion"],
            "opciones"          => $parametros["opciones"],
            "precio"            => $parametros["precio"],
            "moneda"            => $parametros["moneda"],
            "cantidad"          => $parametros["cantidad"],
            "subtotal"          => $parametros["subtotal"],
            "medio_envio_id"    => $parametros["medio_envio_id"]
        ]);

        return $detalle;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
