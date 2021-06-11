@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.compras')}}">Compras</a></li>
        <li class="active"><a style="color:white" href="">lista de entradas</a></li>
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
                <div class="body">
                    <div class="row clearfix">
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">FECHA</label>
                                        <input type="date" disabled id="datePicker" name="fecha" class="form-control" value="{{strtoupper($compra->fecha)}}">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">BODEGA</label>
                                        <div  style="display: flex; width: 100%">
                                            <input type="text" disabled  class="form-control" value="{{strtoupper($compra->bodega->nombre)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">FACTURA DE COMPRA</label>
                                            <input type="text" disabled class="form-control" value="{{strtoupper($compra->serie)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">PROVEEDOR</label>
                                            <input type="text" disabled class="form-control" value="{{strtoupper($compra->proveedor->nombre)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead class="bg-info" >
                                        <th>Nombre</th>
                                        <th>Embalaje</th>
                                        <th>Cantidad</th>
                                        <th>Costo</th>
                                        <th>Subtotal</th>
                                        </thead>
                                        </tbody>
                                        @foreach($dcompra as $detalle)
                                            <tr>
                                                <td>{{$detalle->producto_embalaje->producto->nombre}}</td>
                                                <td>{{$detalle->producto_embalaje->embalaje->descripcion}}</td>
                                                <td>{{$detalle->cantidad}}</td>
                                                <td>{{number_format($detalle->costo)}}</td>
                                                <td>{{number_format($detalle->cantidad * $detalle->costo)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" style="text-align: right;">TOTAL:</td>
                                            <td>{{number_format($compra->total)}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <img style="max-width:100%" src="{{asset('storage').'/'.$compra->foto}}" alt="">
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
