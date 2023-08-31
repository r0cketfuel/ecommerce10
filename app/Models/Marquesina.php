<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marquesina extends Model
{
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        "mensaje",
        "valido_desde",
        "valido_hasta"
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function vigentes()
    {
        return(self::all()->where("valido_desde","<=",date("Y-m-d H:i:s"))->where("valido_hasta",">=",date("Y-m-d H:i:s")));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
