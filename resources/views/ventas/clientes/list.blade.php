@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
    <li class="active"><a style="color:white" href="{{route('clientes.index')}}">Clientes</a></li>
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
                            <li><a href="{{ route('clientes.create') }}">Agregar Nuevo cliente</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>telefono</th>
                                <th>Email</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $clientes)
                            <tr>
                                <td>{{$clientes->identificacion}}
                                <td>{{$clientes->nombres}}
                                <td>{{$clientes->apellidos}}
                                <td>{{$clientes->telefono}}
                                <td>{{$clientes->email}}
                                <td>{{$clientes->created_at}}</td>
                                <td>{{$clientes->updated_at}}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('clientes.edit',$clientes->id)}}"
                                       class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                       data-placement="top" title="Editar Cliente"><i
                                            class="material-icons">mode_edit</i></a>
                                    <a href="{{ route('clientes.delete',$clientes->id)}}"
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
