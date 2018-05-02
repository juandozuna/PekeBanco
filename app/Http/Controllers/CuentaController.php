<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Cuenta;
use App\Transaccion;

define('NUMERO_LIMITE_DE_CUENTAS', 3);

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
     * @param Request $request
     * @param $id
     */
    public function store(Request $request, $id){
        $cliente = Cliente::findOrFail($id);
        if($cliente == null) return response('La operacion no ha sido posible', 404);

        //TODO: Establecer el número máximo de cuentas posibles por cliente
        if( count($cliente->cuentas) > NUMERO_LIMITE_DE_CUENTAS){

        }

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
                if($amount < $cuenta->balance) {
                    $cuenta->balance -= $amount;
                    $transaccion->tipo = "Retiro";
                }else{
                    return Response()->json(['error'=> 'No tiene suficientes fondos para hacer el retiro de '.$amount.' PEKOS'], 404);
                }
                break;
            case 'd':
                $cuenta->balance += $amount;
                $transaccion->tipo = "Deposito";
                break;
            default:
                break;
        }
        
        $transaccion->cuenta_id = $cuenta->id;
        $transaccion->balance = $cuenta->balance;
        $transaccion->amount = $amount;
        
        $transaccion->save();
        $cuenta->save();
        return response()->json(['cuenta' => $cuenta, 'transaccion' => $transaccion]);
    }


    public function RetirarTodo($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        if ($cuenta == null) return response('la cuenta no fue encontrada', 404);

        $tipo = 'Retiro';
        $amount = $cuenta->balance;
        $cuenta->balance = 0;

        $transaccion = new Transaccion();
        $transaccion->balance = $amount;
        $transaccion->tipo = $tipo;
        $transaccion->amount = $amount;
        $transaccion->save();
        return $transaccion;
    }
}
