@extends('layouts.main')

@section('title', $cliente->nombre. " Perfil")


@section('content')


<div id="singleClient">
    <transaccion-modal></transaccion-modal>
    <br>
    <h1 class="display-4 text-center text-secondary theme-font">Perfil Cliente</h1>
    <h1 class="theme-font text-center text-primary">{{$cliente->nombre_completo()}} </h1>

    <div>
        <h2 class="theme-font">Tarjeta: {{wordwrap($cliente->tarjeta->codigoTarjeta , 4 , ' ' , true )}}</h2>
    </div>


    <div class="row">
        <div class="col">
            <div class="container box">
                <h1 class="theme-font text-center text-danger">Cuentas de Banco</h1>
                @foreach($cliente->cuentas as $cuenta)
                    <div class="cuenta">
                        <strong>{{$cuenta->numero_cuenta}}</strong> | Balance: <strong>{{ sprintf('%0.2f', $cuenta->balance)}} <span class="theme-font">PEKOS</span> </strong>
                       &nbsp;&nbsp; <button class="btn btn-outline-primary" v-on:click="activarCuenta({{$cuenta->id}})">Activar</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col">
            <div class="container box">
                <cliente-cuenta-info></cliente-cuenta-info>
            </div>
        </div>
    </div>

    <div class="float-right">
        <a href="{{route('clientes.index')}}" class="btn btn-danger">Volver a listado</a>
    </div>
</div>

@endsection


@section('styles')
    <style>
        .row .col .box{
            border-radius: 4px;
            box-shadow: inset 2px 1px 6px 3px rgba(0,0,0,0.2);
            height: 56vh;
            background: linear-gradient(to top, #00f7d57a, #a6fbff94);
            padding: 11px 19px;
        }

        .cuenta{
            background-color: #ffffffab;
            border-radius: 10px;
            padding: 6px 11px;
            margin-bottom: 10px;
            box-shadow: 4px 4px 3px rgba(0,0,0,0.3);
            font-size: 1.4em;
        }
    </style>
@endsection
