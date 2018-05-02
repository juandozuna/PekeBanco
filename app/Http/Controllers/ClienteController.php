<?php

namespace App\Http\Controllers;
use App\Tarjeta;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Cliente;
use App\Cuenta;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Retornar listado de todos los clientes
        $clientes = Cliente::with('cuentas')->with('tarjeta')->get();
        return $clientes->toJson();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO: Ver Perfil de un solo cliente
        try {
            $i = Crypt::decryptString($id);
            $cliente = Cliente::findOrFail($i);
            return view('clientes.show', ['cliente' => $cliente]);
        }
        catch(DecryptException $e) {
            return  redirect()->route('clientes.index');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //TODO: Mostar formulario para crear un cliente nuevo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tarjeta' => 'required|unique',
            'balance' => 'required',
            'nombre' => 'required',
            'apellido' => 'required'
        ]);

        //TODO: Agregar cliente nuevo a la base de datos.
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $nacimiento = $request->fecha;
        
        $cliente = new Cliente($nombre, $apellido, $nacimiento);
        $cliente->save();
        $cid = $cliente->id;

        $tarjeta = new Tarjeta();
        $tarjeta->codigoTarjeta = $request->tarjeta;
        $tarjeta->cliente_id = $cliente->id;
        $tarjeta->save();
        //TODO: Abrir una cuenta automaticamente para el nuevo cliente
        $cuenta = new Cuenta($cid, $request->balance);
        $cuenta->save();

        return $cliente->with('cuentas')->with('tarjeta')->get()->toJson();

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: Mostrar formulario para editar cliente
    }

    /**
     * Update the specified resource in storage.
     * THis will only update basic information, nothing.
     * related to the accounts related to this user.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Modificar cliente

        //Buscar  cliente
        $cliente = Cliente::findOrFail($id);
        if($cliente == null) return response("El cliente no fue encontrado", 404);

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha;

        return $cliente;
    }

    public function createAccount(Request $request, $id){
        $cliente = Cliente::findOrFail($id);
        if($cliente == null) return;

        $cuenta = new Cuenta($id, $request->balance);
        $cuenta->save();
        return $cuenta;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        if($cliente == null) return response("El cliente no fue encontrado", 404);

        $cliente->trashed = true;

    }
}
