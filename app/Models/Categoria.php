<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'creado';
    const UPDATED_AT = 'actualizado';
    const DELETED_AT = 'eliminado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "nombre",
        "descripcion"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->hasMany(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function eliminaCategoria(int $id): int
    {
        $categoria = self::find($id);
    
        if($categoria)
        {
            $categoria->update(['eliminado' => false]);
    
            return(1);
        }
    
        return(0);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}