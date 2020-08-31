@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.reportes')}}">Reportes</a></li>
    <li class="active"><a style="color:white" >Lista de Precios</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    REPORTES - LISTA DE PRECIO
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Embalaje</th>
                                <th>Precio de Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $item)
                            @foreach($item->embalajes as $embalaje)
                            <tr>
                                <td>{{$item->nombre.'x'.$item->presentacion}}
                                <td>{{$embalaje->descripcion.'x'.$embalaje->pivot->unidades}}
                                <td>$ {{number_format($embalaje->pivot->precio_venta)}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

