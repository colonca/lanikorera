@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white"  href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li><a style="color:white" href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="active"><a style="color:white" href="">Facturas de {{$cliente->nombres}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - CLIENTES - LISTADO DE FACTURAS.<small>Haga clic en el botón  para ver las facturas del cliente.</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover table-responsive table-condensed " width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>factura</th>
                                <th>Modalidad de Pago</th>
                                <th>Medio de Pago</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cliente->facturas as $factura)
                                <tr>
                                    <td>{{$factura->serie.'-'.$factura->n_venta}}</td>
                                    <td>{{$factura->modalidad_pago}}</td>
                                    <td>{{$factura->medio_pago}}</td>
                                    <td>{{date('Y-m-d h:m A',strtotime($factura->fecha))}}</td>
                                    <td>{{number_format($factura->total)}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{route('facturas.detalles', $factura->id)}}"
                                           class="btn bg-green waves-effect btn-xs" data-toggle="tooltip"
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
                 columnDefs: [ { type: 'date', 'targets': [3] } ],
                "order": [[3, "desc" ]] // Sort by first column descending
            });
        });
    </script>
@endsection
