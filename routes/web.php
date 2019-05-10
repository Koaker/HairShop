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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/* MODULO USUARIO */


Route::get('/cadastro-cliente', 'UserControl@formCadastroCliente')->name('frm-cadastro-cliente');

/* FINAL MODULO USUÁRIO */

/* MODULO SERVIÇO */

Route::get('/cadastro-servico', 'ServicoControl@formCadastroServico')->name('frm-cadastro-servico');

/* FINAL MODULO USUÁRIO */

Route::get('/cadastro-cargo', 'CargoControl@formCadastroCargo')->name('frm-cadastro-cargo');