<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'email',
        'fecha_alta',
        'estado'
    ];

    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public static function find(string $email, int $estado = 1)
	{
        //=======================================================================================//
        // Método que busca un correo en la base de datos y si lo encuentra devuelve el registro //
        //=======================================================================================//

        return(Newsletter::where('email', $email)->where('estado', $estado)->get());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function suscribe(string $email): array
    {
        //=============================================//
        // Método que suscribe un correo al newsletter //
        //=============================================//
        
        // Verificar si el correo se encuentra en la base de datos y está activo
        if(Newsletter::find($email, 1)->count())
        {
            session()->put('shop.newsletter.email', $email);

            $response   = array(
                'success'       => false,
                'data'          => array(
                    'message'   => 'El correo ingresado ya se encuentra registrado en nuestro Newsletter'
                ),
            );
            
            return($response);
        }

        $newsletter = Newsletter::firstOrNew(['email' => $email]);
        $newsletter->fecha_alta = timestamp();
        $newsletter->estado     = 1;

        if($newsletter->save())
        {
            session()->put('shop.newsletter.email', $email);
            
            $response   = array(
                'success'       => true,
                'data'          => array(
                    'message'   => 'Te suscribiste a nuestro Newsletter'
                ),
            );
        }
        else
        {
            $response = array(
                'success'       => false,
                'data'          => array(
                    'message'   => 'Algo salió mal'
                ),
            );
        }

        return($response);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
