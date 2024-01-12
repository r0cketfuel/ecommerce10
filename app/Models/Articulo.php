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
        'moneda',
        'categoria_id',
        'subcategoria_id',
        'estado'
    ];
    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function detalle()
    {
        return $this->hasOne(DetalleArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributos()
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
    public function ratings()
    {
        return $this->hasOne(Rating::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function imagenes()
    {
        return $this->hasMany(ImagenArticulo::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function promocion()
    {
        return $this->hasOne(Promocion::class);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function rutaImagenes($items)
    {
        foreach ($items as $item) 
        {
            if($item->imagenes->isNotEmpty())
            {
                foreach ($item->imagenes as $imagen)
                {
                    $imagen->miniatura  = asset(config('constants.product_images') . '/' . $item->id . '/thumbs/'   . $imagen->ruta);
                    $imagen->ruta       = asset(config('constants.product_images') . '/' . $item->id . '/'          . $imagen->ruta);
                }
            }
        }
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
                ->with('imagenes')
                ->with('detalle')
                ->with('categoria')
                ->with('subcategoria')
                ->with('ratings')
                ->with('reviews')
                ->with(['promocion' => function ($query) { $query->where('valido_desde', '<=', now())->where('valido_hasta', '>=', now());}])
                ->first();
    
            if($articulo)
            {
                $articulo->precio = $articulo->precio - ($articulo->precio * $articulo->promocion->descuento / 100);

                self::rutaImagenes([$articulo]);
                return($articulo);
            }
        }
    
        return NULL;
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public static function search(array $search)
	{
        //=============================================//
        // Método que devuelve un listado de artículos //
        //=============================================//

        $query = self::where('estado', 1)->with('imagenes');

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

        self::rutaImagenes($items);
    
        return $items;
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}