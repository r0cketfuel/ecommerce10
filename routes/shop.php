<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MailController;


//============================//
// Rutas sistema de ecommerce //
//============================//

Route::controller(ShopController::class)->group(function () {
    Route::get('',                  	'index');
    Route::get('item/{id}',         	'item');
    Route::get('banners/{banner}',  	'banners');
    Route::get('login',             	'login')->name('user.login');
    Route::get('register',          	'register');
    Route::get('recovery',          	'recovery');
    Route::get('infopago/{id}',     	'infoPago');
    Route::get('logout',				'logout');

    Route::get('tests',				    'tests');

    // Rutas que requieren autenticación
    Route::middleware(['extend.auth'])->group(function () {
        Route::get('favoritos',        	'favoritos');
        Route::get('checkout',         	'checkout');
        Route::post('checkout',        	'checkout');
        Route::get('payment',          	'payment');
        Route::get('success',          	'success');

        Route::get('account',          	'account')->name('user.account');
        Route::post('account',          'account');
    });
});

Route::controller(MailController::class)->group(function () {
    Route::get('/email',                'signup');
});

Route::controller(UserController::class)->group(function () {
    Route::post('login',                'login')->name('login.user');
    Route::post('login/guest',          'loginGuest')->name('login.guest');
    Route::post('register',             'register');
    Route::post('recovery',             'recovery');
});

// Procesador de pagos
Route::post('shop/process_payment', [PaymentController::class, 'process_payment']);

// Shop AJAX requests
Route::controller(AjaxController::class)->group(function () {
    Route::post('shop/ajax/infoItem',           'infoItem');
    Route::post('shop/ajax/atributosItem',      'atributosItem');
    Route::post('shop/ajax/getItemInfoAndAttributes/{id}',      'getItemInfoAndAttributes');
    
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