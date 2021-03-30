@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb " style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color: white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color: white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color: white"href="{{route('deuda.index')}}">Deudas</a></li>
        <li class="active"><a style="color: white">Facturas en Deuda</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - DEUDAS - LISTADO FACTURAS ADEUDADAS POR EL CLIENTE. <small>Visualice los detalles de las facturas adeudadas por el cliente y Realice abonos</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover table-responsive table-condensed" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id factura</th>
                                <th>Nombres</th>
                                <th>Total</th>
                                <th>Abonos</th>
                                <th>Restante</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($facturas as $factura)
                                <tr>
                                    <td>{{$factura->serie.'-'.$factura->n_venta}}</td>
                                    <td>{{$factura->nombres}}</td>
                                    <td>{{number_format($factura->total)}}</td>
                                    <td>{{number_format($factura->abonos)}}</td>
                                    <td>{{number_format($factura->resta)}}</td>
                                    <td>{{date('Y-m-d h:m A',strtotime($factura->created_at))}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('deuda.detalles',$factura->id)}}"
                                           class="btn bg-green waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver detalles"><i
                                                class="material-icons">remove_red_eye</i></a>
                                        <a href="{{ route('deuda.edit',$factura->id)}}"
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Abonar"><i
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
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "order": [[5, "desc" ]] // Sort by first column descending
            });
        });
    </script>
@endsection
