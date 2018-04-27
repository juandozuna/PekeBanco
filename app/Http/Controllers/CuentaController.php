<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Transaccion;

class CuentaController extends Controller
{
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        if($cuenta->balance > 0);
            return array('error' => 'No puede borrar la cuenta hasta que retire todo su contenido');

        $cuenta->delete();
    }


    /** 
    * Este metodo se ocupa del manejo y registro de las transacciones 
    * 
    * @param int $cuentaId
    * @return \Iluminate\Http\Response
    */
    public function transaccion(Request $request, $cuentaId){
        $cuenta = Cuenta::findOrFail($cuentaId);
        if($cuenta == null) return response("La cuenta no fue encontrada", 404);

        $tipo = $request->tipo;
        $amount = $request->amount;
        $transaccion = new Transaccion();
        
        switch($tipo){
            case 'r':
                $cuenta->balance -= $amount;
                $transaccion->tipo = "Retiro";
                break;
            case 'd':
                $cuenta->balance += $amount;
                $transaccion->tipo = "Deposito";
                break;
            default:
                break;
        }
        
        $transaccion->cuenta_id = $cuenta->id;
        $transaccion->amount = $amount;
        
        $transaccion->save();
        $cuenta->save();
        return response()->json(['cuenta' => $cuenta, 'transaccion' => $transaccion]);
    }
}
