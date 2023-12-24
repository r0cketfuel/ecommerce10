<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ArticuloController;
use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\SubcategoriaController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\FavoritoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('articulos',     ArticuloController::class);
Route::apiResource('categorias',    CategoriaController::class);
Route::apiResource('subcategorias', SubcategoriaController::class);
Route::apiResource('usuarios',      UsuarioController::class);
Route::apiResource('favoritos',     FavoritoController::class);

Route::post('usuarios/check-username-availability', [UsuarioController::class, 'checkUsernameAvailability']);