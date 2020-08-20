@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a href="{{route('deuda.index')}}">Deudas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DEUDAS- LISTADO DE DEUDAS POR CLIENTES.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id factura</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Total</th>
                                <th>Abonos</th>
                                <th>Restante</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($facturas as $factura)
                                <tr>
                                    <td>{{$factura->serie.'-'.$factura->n_venta}}</td>
                                    <td>{{$factura->nombres}}</td>
                                    <td>{{$factura->apellidos}}</td>
                                    <td>{{$factura->total}}</td>
                                    <td>{{$factura->abonos}}</td>
                                    <td>{{$factura->resta}}</td>
                                    <td style="text-align: center;">

                                        <a href="{{ route('deuda.edit',$factura->id)}}"

                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Mostrar detalles"><i
                                                class="material-icons">mode_edit</i></a>

                                        <a href="{{ route('clientes.delete',$factura->id)}}"
                                           class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Eliminar Cliente"><i
                                                class="material-icons">delete</i></a>
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
