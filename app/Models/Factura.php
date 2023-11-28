<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'numero',
        'fecha',
        'tipo_factura_id',
        'apellidos',
        'nombres',
        'tipo_documento_id',
        'documento_nro',
        'cuil',
        'cuit',
        'domicilio',
        'domicilio_nro',
        'domicilio_piso',
        'domicilio_depto',
        'localidad',
        'codigo_postal',
        'total',
        'medio_pago_id',
        'medio_envio_id',
        'cae',
        'cae_vto',
        'estado_id'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function tipos()
    {
        return $this->belongsTo(TipoFactura::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function estados()
    {
        return $this->belongsTo(FacturaEstado::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function generarFactura(array $parametros): Factura
    {
        //=====================================//
        // Método que genera una nueva factura //
        //=====================================//

        $factura = self::create([
            'numero'            => self::max('numero') + 1,
            'fecha'             => now(),
            'tipo_factura_id'   => $parametros['tipo_factura_id'],
            'apellidos'         => $parametros['apellidos'],
            'nombres'           => $parametros['nombres'],
            'tipo_documento_id' => $parametros['tipo_documento_id'],
            'documento_nro'     => $parametros['documento_nro'],
            'cuil'              => $parametros['cuil'] ?? NULL,
            'cuit'              => $parametros['cuit'] ?? NULL,
            'domicilio'         => $parametros['domicilio'],
            'domicilio_nro'     => $parametros['domicilio_nro'],
            'domicilio_piso'    => $parametros['domicilio_piso']    ?? NULL,
            'domicilio_depto'   => $parametros['domicilio_depto']   ?? NULL,
            'localidad'         => $parametros['localidad'],
            'codigo_postal'     => $parametros['codigo_postal'],
            'telefono_celular'  => $parametros['telefono_celular']  ?? NULL,
            'telefono_alt'      => $parametros['telefono_alt']      ?? NULL,
            'total'             => $parametros['total'],
            'medio_pago_id'     => $parametros['medio_pago_id'],
            'medio_envio_id'    => $parametros['medio_envio_id'],
            'cae'               => $parametros['cae'],
            'cae_vto'           => $parametros['cae_vto'],
            'estado_id'         => $parametros['estado_id']
        ]);

        return $factura;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
