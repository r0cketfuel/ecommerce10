<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleArticulo extends Model
{
    protected $table    = "detalles_articulos";
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "articulo_id",
        "detalle",
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function detalle(int $id)
    {
        //==========================================//
        // Método que carga el detalle del artículo //
        //==========================================//
        return(self::where("articulo_id", $id)->first());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
