@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="active"><a style="color:white" href="">Creando nuevo Cliente</a></li>
    </ol>
@endsection
@section('style')
    <style>
        .form-line {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE VENTAS - CLIENTES EN EL SISTEMA. <small>Ingrese los datos y haga click en el boton Guardar.</small>
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <h1 class="card-inside-title">DATOS DEL CLIENTE</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('clientes.store')}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Nombres</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba nombre del cliente" name="nombres"required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Apellidos</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente" name="apellidos" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Telefono</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente" name="telefono" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Email</label>
                                        <br/><input type="email" class="form-control" placeholder="email@example.com" name="email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('clientes.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
