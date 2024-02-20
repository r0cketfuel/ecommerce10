<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
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
        'codigo',
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'subcategoria_id',
        'estado'
    ];
    
    protected $hidden = [
        'creado',
        'actualizado',
        'eliminado'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function detalle()
    {
        return $this->hasOne(DetalleArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributo()
    {
        return $this->hasMany(AtributoArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function imagen()
    {
        return $this->hasMany(ImagenArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function promocion()
    {
        return $this->hasOne(Promocion::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function info(int $id)
    {
        //=====================================================================//
        // Método que devuelve un artículo con toda la información relacionada //
        //=====================================================================//

        if($id > 0)
        {
            $articulo = self::where('id', $id)
                ->with('atributo.talle')
                ->with('imagen')
                ->with('detalle')
                ->with('categoria')
                ->with('subcategoria')
                ->with('review.usuario')
                ->with(['promocion' => function ($query) { $query->where('valido_desde', '<=', now())->where('valido_hasta', '>=', now()); }])
                ->first();

            if($articulo)
                return($articulo);
        }
    
        return NULL;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search(array $search)
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = self::with('imagen')
            ->with(['promocion' => function ($query) { $query->where('valido_desde', '<=', now())->where('valido_hasta', '>=', now()); }])
            ->where('estado', 1);

        if(isset($search['query']))
        {
            $query->where(function ($q) use ($search)
            {
                $q->where('codigo',         'like', '%' . $search['query'] . '%')
                ->orWhere('nombre',         'like', '%' . $search['query'] . '%')
                ->orWhere('descripcion',    'like', '%' . $search['query'] . '%');
            });
        }
    
        if(isset($search['categoria']))
            $query->where('categoria_id', $search['categoria']);
    
        if(isset($search['subcategoria']))
            $query->where('subcategoria_id', $search['subcategoria']);

        if(isset($search['sort']))
            if(isset($search['order']))
                $query->orderBy($search['sort'], $search['order']);
        
        $items = $query->paginate(config('constants.pagination'));
    
        return $items;
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function precio(int $id)
    {
        //======================================================================//
        // Método que devuelve el precio del artículo o el precio con descuento //
        //======================================================================//

        if($id > 0)
        {
            $articulo = self::where("id", $id)
                ->with(['promocion' => function ($query) { $query->where('valido_desde', '<=', now())->where('valido_hasta', '>=', now()); }])
                ->first();
            
            $precio = $articulo->precio;

            if($articulo->promocion)
                $precio = $articulo->precio - ($articulo->precio * $articulo->promocion->descuento / 100);

            return $precio;
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}