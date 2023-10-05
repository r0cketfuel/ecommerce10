<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page
Route::view('/', 'site.index');

// Shop routes
Route::prefix('shop')->controller(ShopController::class)->group(function () {
    Route::get('',                  	'index');
    Route::get('item/{id}',         	'item');
    Route::get('banners/{banner}',  	'banners');
    Route::get('login',             	'login')->name('user.login');
    Route::get('register',          	'register');
    Route::get('recovery',          	'recovery');
    Route::get('infopago/{id}',     	'infoPago');
    Route::get('logout',				'logout');

    // Rutas que requieren autenticación
    Route::middleware(['auth:web'])->group(function () {
        Route::get('favoritos',        	'favoritos');
        Route::get('checkout',         	'checkout');
        Route::post('checkout',        	'checkout');
        Route::get('payment',          	'payment');
        Route::get('success',          	'success');
        Route::get('account',          	'account');
    });
});

Route::prefix('shop')->controller(UserController::class)->group(function () {
    Route::post('login',           'login');
    Route::post('register',        'register');
    Route::post('recovery',        'recovery');
});

// Procesador de pagos
Route::post('shop/process_payment', [PaymentController::class, 'process_payment']);

// Shop AJAX requests
Route::controller(AjaxController::class)->group(function () {
    Route::post('shop/ajax/infoItem',           'infoItem');
    Route::post('shop/ajax/atributosItem',      'atributosItem');
    Route::post('shop/ajax/updateCart',         'updateCart');
    Route::post('shop/ajax/suscribe',           'suscribe');

    // Rutas que requieren autenticación
    Route::middleware(['auth:web'])->group(function () {
        Route::post('shop/ajax/agregaFavorito',     'agregaFavorito');
        Route::post('shop/ajax/aplicaCupon',        'aplicaCupon');
        Route::post('shop/ajax/eliminaFavorito',    'eliminaFavorito');
        Route::post('shop/ajax/costoEnvio',         'costoEnvio');
    });
});


//===================================//
// Rutas del panel de administración //
//===================================//

Route::prefix('admin')->group(function () {

    Route::get('',          [AdminController::class, 'index'])->name('admin.login');
    Route::post('',         [AdminController::class, 'login']);
    Route::get('logout',    [AdminController::class, 'logout']);

    // Rutas que requieren autenticación
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Rutas CRUD
        Route::resource('articulos',        ArticuloController::class);
        Route::resource('banners',          BannerController::class);
        Route::resource('categorias',       CategoriaController::class);
        Route::resource('subcategorias',    SubcategoriaController::class);
    });
});