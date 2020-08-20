@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb " style="margin-bottom: 30px;ackground-color: #38383A">
        <li><a style="color:white"  href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('deuda.index')}}">Deudas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - CLIENTES EN EL SISTEMA.<small>Haga clic en el botón de 3 puntos de la derecha de este título para agregar un nuevo registro.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="{{ route('devoluciones.create') }}">Devolver Factura</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>factura</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($facturas as $factura)
                                <tr>
                                    <td>{{$factura->serie.'-'.$factura->n_venta}}</td>
                                    <td>{{$factura->cliente->nombres.''.$factura->cliente->apellidos}}</td>
                                    <td>{{$factura->fecha}}</td>
                                    <td>{{$factura->total}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{route('devoluciones.show',$factura->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar abono"><i class="fas fa-eye"></i></a>
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
            //$('#tabla').DataTable();
        });
    </script>
@endsection
