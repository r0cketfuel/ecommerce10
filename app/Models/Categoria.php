<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "nombre",
        "descripcion",
        "activo"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        //====================================================//
        // Relación categorias[id] -> articulos[categoria_id] //
        //====================================================//
        return($this->hasMany(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function eliminaCategoria(int $id): int
    {
        $categoria = self::find($id);
    
        if($categoria)
        {
            $categoria->update(['activo' => false]);
    
            return(1);
        }
    
        return(0);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}