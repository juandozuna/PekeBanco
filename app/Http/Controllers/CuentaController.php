<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cache;
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


    public function create($id){

        try {
            $i = Crypt::decryptString($id);
            $cliente = Cliente::findOrFail($i);
            $numero = $this->crearNumeroCuenta();
            if(count($cliente->cuentas) < NUMERO_LIMITE_DE_CUENTAS)
                return view('clientes.cuenta', ['cliente' => $cliente, 'numero' => $numero]);
            else
                return redirect()->route('cliente.show',['id' => $cliente->hashed_id]);
        }
        catch(DecryptException $e) {
            return  redirect()->route('clientes.index');
        }
    }


    /**
     * @param Request $request
     * @param $id
     */
    public function store($id, Request $request){
        //TODO: Establecer el número máximo de cuentas posibles por cliente
        $cliente = Cliente::findOrFail($request->client_id);
        if( count($cliente->cuentas) < NUMERO_LIMITE_DE_CUENTAS){
            $cuenta = new Cuenta();
            $cuenta->client_id = $request->client_id;
            $cuenta->balance = $request->balance;
            $cuenta->numero_cuenta = $request->numero_cuenta;
            $cuenta->save();
            return redirect()->route('clientes.show', ['id' => $id]);
        }else {
            return response('Hubo un error en el proceso', 404);
        }
    }

    /**
    * Este metodo se ocupa del manejo y registro de las transacciones
    *
    * @param int $cuentaId
    * @return \Iluminate\Http\Response
    */
    public function transaccion(Request $request, $cuentaId){

        $request->validate([
            "amount" => 'required'
        ]);

        $cuenta = Cuenta::findOrFail($cuentaId);
        if($cuenta == null) return response("La cuenta no fue encontrada", 404);

        $tipo = $request->input('tipo');
        $amount = $request->input('amount');
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


    private function RetirarTodo($id)
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
        return $cuenta;
    }


    public function close($id){
        $cuenta = Cuenta::findOrFail($id);
        if($cuenta == null) return response ('La cuenta no fue encontrada', 404);

        Transaccion::where('cuenta_id', $id)->delete();

        Cuenta::destroy($id);
        return response()->json(['La cuenta ha sido eliminada exitosamente', 200]);
    }



    private function crearNumeroCuenta(){
        $num = rand(100000000,9999999999);
        $cuentas = Cuenta::all();
        $continue = true;
        while($continue){
            foreach ($cuentas as $cuenta){
                if($cuenta->numero_cuenta == $num){
                    $num = rand(1000000,9999999999);
                    $continue = true;
                    break;
                }
            }
            $continue = false;
        }
        return $num;
    }
}


