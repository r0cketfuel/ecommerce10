<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

use App\Models\InfoComercio;

class InfoComercioService
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function info(): void
    {
        //===================================================//
        // Método que carga toda la información del comercio //
        //===================================================//

        if(!session()->has("infoComercio"))
            Session::put("infoComercio", InfoComercio::first()->toArray());

    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
