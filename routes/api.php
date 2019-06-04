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

Route::post('/cadastrarCliente', 'UserControl@CadastroCliente')->name('cadastrarCliente');
Route::put('/editarCliente', 'UserControl@EditarCliente')->name('editarCliente');
Route::post('/deletarCliente', 'userControl@deletarCliente')->name('deletarCliente');

/* FINAL USER */ 


/* SERVICO */ 


Route::post('/cadastrarServico', 'ServicoControl@store')->name('cadastrarServico');


/* FINAL SERVICO */ 


/* Cargo */ 


Route::post('/cadastrarCargo', 'CargoControl@store')->name('cadastrarCargo');



/* FINAL Cargo */ 


/* Cargo */ 


Route::post('/solicitarAgendamento', 'AgendamentoControl@store')->name('solicitarAgendamento');
Route::delete('/cancelarAgendamento', 'AgendamentoControl@cancelar')->name('cancelarAgendamento');
Route::put('/remarcarAgendamento', 'AgendamentoControl@remarcar')->name('remarcarAgendamento');



/* FINAL Cargo */ 