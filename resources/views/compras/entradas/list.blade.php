@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white"  href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.compras')}}">Compras</a></li>
        <li class="active"><a style="color:white" href=""></a>Entradas</li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE COMPRAS - ENTRADAS DE ALMACEN <small>Haga clic en el botón de 3 puntos de la derecha de este título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('compras.create') }}">Crear Nueva Entrada de Almacen </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover table-responsive table-condensed " width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Bodega</th>
                                <th>Factura de compra</th>
                                <th>Proveedor</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entradas as $entrada)
                                <tr>
                                    <td>{{$entrada->bodega->nombre}}</td>
                                    <td>{{$entrada->serie}}</td>
                                    <td>{{$entrada->proveedor->nombre}}</td>
                                    <td>{{$entrada->created_at}}</td>
                                    <td>{{number_format($entrada->total)}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{route('compras.detalles', $entrada->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver Detalle"><i class="fas fa-eye"></i></a>
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "order": [[3, "desc" ]] // Sort by first column descending
            });
        });
    </script>
@endsection
