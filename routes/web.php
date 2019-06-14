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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();


Route::get('autocomplete', 'UserControl@AutoCompleteCliente')->name('autocomplete-cliente');



Route::get('/home', 'HomeController@index')->name('home');


/* MODULO USUARIO */


Route::get('/cadastro-cliente', 'UserControl@formCadastroCliente')->name('cadastro-cliente');
Route::get('/cadastro-usuario', 'UserControl@formCadastroUsuario')->name('cadastro-usuario');
Route::get('/listar-usuario', 'UserControl@indexWeb')->name('listar-usuario');

/* FINAL MODULO USUÁRIO */

/* MODULO SERVIÇO */

Route::get('/cadastro-servico', 'ServicoControl@formCadastroServico')->name('cadastro-servico');
Route::get('/listar-servico', 'ServicoControl@index')->name('listar-servico');
/* FINAL MODULO SERVIÇO */



/* MODULO CARGO */
Route::get('/cadastro-cargo', 'CargoControl@formCadastroCargo')->name('cadastro-cargo');
Route::get('/listar-cargo', 'CargoControl@index')->name('listar-cargo');

/* FINAL MODULO CARGO */

/*MODULO AGENDAMENTO */
Route::get('/cadastro-agendamento', 'AgendamentoControl@formCadastroAgendamento')->name('cadastro-agendamento');
Route::get('/listar-agendamento', 'AgendamentoControl@indexWeb')->name('listar-agendamento');

/*FINAL MODULO AGENDAMENTO */ 
