@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white"href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('descuentos.index')}}">Descuentos</a></li>
        <li class="active"><a style="color:white" href="">Editado Descuento </a></li>
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
                    DATOS DE VENTAS - DESCUENTOS EN EL SISTEMA - EDITANDO DESCUENTO.<small>Edite los datos en los campos de su elección y haga click en el boton Actualizar</small>
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="row clearfix">
                    <div class="col-md-12" style="margin-bottom: 0;">
                        <form id="form" action="{{route('descuentos.update',$descuento->id)}}" method="POST">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Fecha Inicio</label>
                                        <input type="date" id="datePicker" name="fecha" class="form-control" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Fecha Final</label>
                                        <input type="date" id="datePicker" name="fecha" class="form-control" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-4" style="display: flex">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Codigo de Barras</label>
                                            <input type="hidden" name="producto_embalaje_id" id="producto_embalaje" >
                                            <input type="text" class="form-control" id="cogigo" onkeypress="buscarProducto(event)" placeholder="scanee o ingrese el codigo del producto" value="{{$descuento->codigo_de_barras}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Cantidad Destinda</label>
                                            <br/><input id="cantidad" type="number" class="form-control" placeholder="Cantidad de la promoción" name="cantidad_destinada"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Precio</label>
                                            <br/><input type="text" id="costo_promedio" class="form-control" min="1" placeholder="precio de la promoción" name="valor"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('descuentos.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
