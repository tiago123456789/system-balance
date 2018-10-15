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

Route::prefix("admin")
    ->group(function () {
        Route::get('/balance', 'Admin\\BalanceController@index')->name('balance');
        Route::get('/balance/historic', 'Admin\\HistoricController@index')->name('balance.historic');
        Route::get('/balance/historic-search', 'Admin\\HistoricController@searchHistoric')->name('balance.historic.search');
        Route::get('/balance/transferir', 'Admin\\BalanceController@transferir')->name('balance.transferir');
        Route::post('/balance/transferir/nova', 'Admin\\BalanceController@novaTransferir')->name('balance.transferir.nova');
        Route::get("/balance/sacar", "Admin\\BalanceController@sacar")->name("balance.sacar");
        Route::post("/balance/sacar/novo", "Admin\\BalanceController@novoSacar")->name("balance.sacar.novo");
        Route::get('/balance/recarregar', 'Admin\\BalanceController@recarregar')->name('balance.recarregar');
        Route::post('/balance/recarregar/nova', 'Admin\\BalanceController@novaRecarregar')->name('balance.recarregar.nova');
        Route::get('/', 'HomeController@index')->name('admin');
    });


Route::get("/perfil", "PerfilController@index");
Route::post("/perfil", "PerfilController@update");
