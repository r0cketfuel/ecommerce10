<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\SignUp;

class MailController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function signup()
    {
        $email          = "correo@dominio.com";
        $apellidos      = "Apellidos";
        $nombres        = "Nombres";
        $activationURL  = "as5d234daa7g4fg737s";

        Mail::to($email)->send(new SignUp($apellidos, $nombres, $activationURL));

        echo "Correo enviado!";
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
