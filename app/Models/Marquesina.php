<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marquesina extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'mensaje',
        'valido_desde',
        'valido_hasta'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        return(self::where('valido_desde', '<=', now())->where('valido_hasta', '>=', now())->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
