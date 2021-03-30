@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb " style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color: white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color: white"href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color: white"href="{{route('deuda.index')}}">Deudas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - DEUDAS - LISTADO DE DEUDAS POR CLIENTE. <small>Haga click en el boton verde para ver las facturas que adeuda el cliente</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Total</th>
                                <th>abonos</th>
                                <th>Restante</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombres}}</td>
                                    <td>{{number_format($cliente->total)}}</td>
                                    <td>{{number_format($cliente->abonos)}}</td>
                                    <td>{{number_format($cliente->resta)}}</td>
                                    <td style="text-align: center;">

                                        <a href="{{ route('deuda.show',$cliente->id)}}"

                                           class="btn bg-green waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Ver Facturas"><i
                                                class="material-icons">remove_red_eye</i></a>
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
