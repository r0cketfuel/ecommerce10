<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "categoria_id",
        "nombre",
        "descripcion"
    ];
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        //==================================//
        // Relación categorias -> articulos //
        //==================================//
        return($this->hasMany(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        //======================================//
        // Relación subcategorías -> categorías //
        //======================================//
        return $this->belongsTo(Categoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}