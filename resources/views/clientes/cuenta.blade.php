@extends('layouts.main')

@section('title', "Cuenta Nueva")

@section('content')
    <div id="app" >
    <br>
    <h1 class="display-2 text-center text-danger theme-font">{{$cliente->nombre_completo()}}</h1>
    <h1 class="text-primary text-center">Nueva Cuenta : <span class="text-secondary theme-font">{{$numero}}</span></h1>

    <hr style="background-color: purple">
    <!-- Starts entry form -->
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container">
                <form>
                    {{csrf_field()}}
                    <input type="hidden" value="{{$cliente->id}}" name="client_id">

                    <div class="form-group">
                        <h1 class="text-center">Numero de Cuenta</h1>
                        <input type="text" value="{{$numero}}" disabled="disabled" class="form-control text-center theme-font text-secondary" name="numero_cuenta" style="font-size: 1.5em">
                    </div>


                    <div class="form-group">
                        <h1 class="theme-font text-center display-3">Balance</h1>
                        <input type="number" class="text-center" name="balance" class="form-control text-center">
                    </div>

                    <button class="btn btn-primary" type="submit">Crear</button>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('styles')

    <style>
        .form-container{
            background-color: rgba(255,255,255,0.7);
            box-shadow: inset -1px 2px 5px 2px rgba(0,0,0,0.2);
            padding: 5px;
            border-radius: 14px;
        }

        .form-container .container{
            margin-top: 7px;
        }
    </style>



    @endsection