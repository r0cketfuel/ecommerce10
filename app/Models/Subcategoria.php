<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
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
        'categoria_id',
        'nombre',
        'descripcion'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function articulo()
    {
        return($this->hasMany(Articulo::class));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function eliminaSubcategoria(int $id): int
    {
        $subcategoria = self::find($id);
    
        if($subcategoria)
        {
            $subcategoria->update(['eliminado' => false]);
    
            return(1);
        }
    
        return(0);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}