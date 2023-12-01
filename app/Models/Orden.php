<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Orden extends Model
{
    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';

    protected $table = 'ordenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'factura_id',
        'estado_id'
    ];

}
