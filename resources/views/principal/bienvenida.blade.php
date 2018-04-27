@extends('layouts.main')


@section('title', "Hub Central")


@section('content')


<div style="margin-top: 20%">
    <h1 class="display-4 text-center text-warning theme-font">Buscar cliente con tarjeta <span class="text-danger">Pekepoliana</span></h1>
    <form>
        <div class="form-group">
            <input type="text" class="form-control text-center" placeholder="Click en este espacio y pase la tarjeta por el Scanner" style="background-color:antiquewhite; font-size: 1.3em" maxlength="18">
        </div>
    </form>
</div>

<hr>
<br>
<div class="row text-center">
    <div class="col"> 
        <a href="#" class="btn btn-secondary btn-block btn-home">Clientes </a>
    </div>
    <div class="col"> 
        <a href="#" class="btn btn-secondary btn-block btn-home">Cuentas</a>
    </div>
    <div class="col"> 
        <a href="#" class="btn btn-secondary btn-block btn-home">Transacciones</a>
    </div>
</div>


@endsection

@section('styles')

    <style>

        .home-box{
            border-radius: 5px !important;
            box-shadow: 3px 2px 5px rgba(0,0,0,0.2) !important;:
        }

        .btn.btn-secondary.btn-home{
            text-align: center;
            vertical-align: middle;
        }

        .btn.btn-secondary.btn-home a{
            
        }
    </style>

    @endsection