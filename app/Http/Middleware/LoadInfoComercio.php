<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\InfoComercio;
use App\Models\Sucursal;
use App\Models\Visita;

class LoadInfoComercio
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has("infoComercio")) {
            Session::put("infoComercio", InfoComercio::first()->toArray());
            Session::put("infoComercio.sucursales", Sucursal::all()->toArray());

            Session::put("shop.newsletter", array());

            $this->registrarVisita($request);
        }

        return $next($request);
    }

    /**
     * Registra la visita en la tabla de visitas.
     */
    private function registrarVisita(Request $request)
    {
        $ip = $request->ip();
        $visita = new Visita();
        $visita->ip = $ip;
        $visita->fecha = now();
        $visita->save();
    }
}
