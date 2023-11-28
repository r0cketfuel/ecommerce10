<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFactura extends Model
{
    protected $table    = 'tipos_facturas';
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'tipo',
        'descripcion'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}