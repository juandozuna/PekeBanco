<?php

namespace App\Http\Controllers;

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
        $clientes = Cliente::all();
        return view('clientes.index', ['clientes' => $clientes]);
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
        $cliente = Cliente::findOrFail($id);
        return view('clientes.detail', ['cliente' => $cliente ]);
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
        //TODO: Agregar cliente nuevo a la base de datos.
        $nombre = $request->nombre;
        $apellido = $request->apellido;
        $nacimiento = $request->fecha;
        
        $cliente = new Cliente($nombre, $apellido, $nacimiento);
        $cliente->save();
        $cid = $cliente->id;

        //TODO: Abrir una cuenta automaticamente para el nuevo cliente
        $cuenta = new Cuenta($cid, $request->balance);
        $cuenta->save();

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: Modificar cliente

        //Buscar  cliente
        $cliente = Cliente::findOrFail($id);
        if($cliente == null) return;

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha;
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
        if($cliente == null) return;

        $cliente->trashed = true;

    }
}
