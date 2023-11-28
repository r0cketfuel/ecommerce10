<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'facturas_detalles';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'factura_id',
        'articulo_id',
        'precio',
        'cantidad',
        'subtotal',
        'medio_envio_id'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function generarDetalle(array $parametros): FacturaDetalle
    {
        //===============================================//
        // Método que genera un nuevo detalle de factura //
        //===============================================//

        $detalle = self::create([
            'factura_id'        => $parametros['factura_id'],
            'articulo_id'       => $parametros['articulo_id'],
            'precio'            => $parametros['precio'],
            'cantidad'          => $parametros['cantidad'],
            'subtotal'          => $parametros['subtotal']
        ]);

        return $detalle;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
