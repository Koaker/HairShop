<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* USER */ 
Route::get('/listarUsuarios', 'UserControl@index')->name('listarUsuario');
Route::post('/cadastrarCliente', 'UserControl@CadastroCliente')->name('cadastrarCliente');

/* FINAL USER */ 


/* SERVICO */ 


Route::post('/cadastrarServico', 'ServicoControl@store')->name('cadastrarServico');


/* FINAL SERVICO */ 


/* Cargo */ 


Route::post('/cadastrarCargo', 'CargoControl@store')->name('cadastrarCargo');


/* FINAL Cargo */ 