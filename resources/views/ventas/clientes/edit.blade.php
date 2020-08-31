@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white"href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="active"><a style="color:white" href="">Editado Cliente {{$clientes->nombres}}</a></li>
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
                    DATOS DE VENTAS - CLIENTES EN EL SISTEMA - EDITANDO CLIENTE.<small>Edite los datos en los campos de su elección y haga click en el boton Actualizar</small>
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
                        <form class="form-horizontal" method="POST" action="{{route('clientes.update', $clientes->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Nombres</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba nombre del cliente" value="{{$clientes->nombres}}" name="nombres"required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Apellidos</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente" value="{{$clientes->apellidos}}" name="apellidos" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Telefono</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente" value="{{$clientes->telefono}}" name="telefono" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Email</label>
                                        <br/><input type="email" class="form-control" placeholder="email@example.com" value="{{$clientes->email}}" name="email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('clientes.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
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
