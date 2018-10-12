<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Inicio@index');

Route::post('/personalizar', 'Personalizar@consultar');

Route::post('/personalizar/registrar', 'Personalizar@registrar');

Route::get('/personalizar/datos_enviados', 'Personalizar@datos_enviados');

Route::post('/personalizar/log_error', 'Personalizar@log_error');

Route::get('/registrar/confirmar/{random_code}', 'Registrar@confirmar');

Route::post('/registrar/verificar_code', 'Registrar@verificar_code');

Route::post('/registrar/log_error', 'Registrar@log_error');

Route::post('/cargarsaldo', 'CargarSaldo@post');

Route::post('/movimientos', 'Movimientos@post');

Route::post('/contacto', 'Contacto@post');

Route::get('/getprk', 'Inicio@get_prk');

Route::get('/getpv', 'Inicio@get_pv');

Route::get('/getLineas', 'Lineas@getLineas');

Route::get('/getRecorrido', 'Lineas@getRecorrido');
