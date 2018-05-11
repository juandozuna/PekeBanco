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


Route::prefix('clientes')->group(function(){
   Route::get('all', 'ClienteController@index');
});

Route::get('cuenta/{id}', function($id){
   $cuenta = App\Cuenta::with('transacciones')->findOrFail($id);
   return $cuenta;
});


Route::post('cliente', 'ClienteController@store');


Route::post('cuenta/{id}', 'CuentaController@transaccion');
Route::delete('cuenta/{id}/cerrar', 'CuentaController@close');
