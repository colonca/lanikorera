@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="">Devolución</a></li>
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
                        DATOS DE FACTURA - DEVOLUCIÓN <small>Ingrese los datos y haga click en el boton Consultar, para visualizar la factura a devolver.</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="row clearfix">
                        @if(isset($factura))
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" disabled id="datePicker" name="fecha" class="form-control" value="{{$factura->fecha}}">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">CLIENTE</label>
                                        <div  style="display: flex; width: 100%">
                                            <input type="text" disabled  class="form-control" value="{{strtoupper($factura->cliente->nombres).' '.strtoupper($factura->cliente->apellidos)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-4" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">MODALIDAD DE PAGO</label>
                                            <input type="text" disabled class="form-control" value="{{strtoupper($factura->modalidad_pago)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Medio de pago</label>
                                            <input type="text" disabled class="form-control" value="{{strtoupper($factura->medio_pago)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Factura de Venta</label>
                                            <input type="text" disabled class="form-control" value="{{$factura->serie.'-'.$factura->n_venta}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead class="bg-info" >
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Embalaje</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                        </thead>
                                        <tbody id="productos">
                                        <?php $total = 0?>
                                        @foreach($factura->dfactura as $detalle)
                                            <tr>
                                                <td>{{$detalle->producto_embalaje->codigo_de_barras}}</td>
                                                <td>{{$detalle->producto_embalaje->producto->nombre.'X'.$detalle->producto_embalaje->producto->presentacion}}</td>
                                                <td>{{$detalle->producto_embalaje->embalaje->descripcion}}</td>
                                                <td>{{$detalle->cantidad}}</td>
                                                <td>$ {{number_format($detalle->precio)}}</td>
                                                <td>$ {{number_format($detalle->cantidad*$detalle->precio)}}</td>
                                            </tr>
                                        @endforeach
                                        @foreach(json_decode($factura->adicionales) as $adicional)
                                            <tr>
                                                <td>{{$adicional->unicode}}</td>
                                                <td>{{$adicional->nombre}}</td>
                                                <td>UNIDAD</td>
                                                <td>{{$adicional->cantidad}}</td>
                                                <td>$ {{$adicional->precio}}</td>
                                                <td>$ {{number_format($adicional->total)}}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="5" style="text-align: right;">Total:</td>
                                                <td>{{$factura->total}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
