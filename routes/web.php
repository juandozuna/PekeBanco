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

Route::get('/', function(){
    return view('principal.bienvenida');
});


Auth::routes();


Route::prefix('clientes')->group(function(){
    Route::get('/', function(){
        return view('clientes.index');
    })->name('clientes.index');

    Route::get('{id}/perfil', 'ClienteController@show');
});


