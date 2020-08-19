@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white"href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('deuda.index')}}">Clientes</a></li>
        <li class="active"><a style="color:white" href="">Actualizar abono</a></li>
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
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - DEUDAS POR CLIENTE - ABONAR.<small>Ingrese el valor a abonar y haga click en abonar</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DE DEUDA</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('clientes.update', $clientes->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT" />
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line" >
                                            <label for="exampleFormControlSelect1">Id factura</label>
                                            <br/><input type="number" class="form-control" value="{{$clientes->identificacion}}" name="idFactura" disabled />
                                        </div>
                                        <div class="form-line" >
                                            <label for="exampleFormControlSelect1">Identidicación</label>
                                            <br/><input type="number" class="form-control" value="{{$clientes->identificacion}}" name="identificacion" disabled />
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Nombres</label>
                                            <br/><input type="text" class="form-control" value="{{$clientes->nombres}}" name="nombres"disabled/>
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Restante</label>
                                            <br/><input type="number" class="form-control"  name="restante" disabled/>
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Valor a abonar</label>
                                            <br/><input type="number" class="form-control" placeholder="0.00"  name="valor" required="required" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn bg-green waves-effect" type="submit">Abonar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>
                        LISTADO DE DEUDAS POR FACTURA.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>factura</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Total</th>
                                <th>abonos</th>
                                <th>estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $clientes)
                                <tr>
                                    <td>{{$clientes->n_venta}}
                                    <td>{{$clientes->nombres}}
                                    <td>{{$clientes->apellidos}}
                                    <td>{{$clientes->total}}
                                    <td>{{$clientes->abonos}}
                                    <td>{{$clientes->estado}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('abono.edit',$clientes->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar abono"><i
                                                class="material-icons">mode_edit</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
