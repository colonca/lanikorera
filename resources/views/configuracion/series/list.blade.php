@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.configuracion')}}">Configuración</a></li>
    <li class="active"><a style="color:white" href="{{route('series.index')}}">Series</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE CONFIGURACIÓN - SERIES DE FACTURAS.<small>Haga clic en el botón de 3 puntos de la derecha de este título para agregar un nuevo registro.</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('series.create') }}">Agregar Nueva Serie</a></li>
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
                                <th>Prefijo</th>
                                <th>Numero Inicial</th>
                                <th>Numero Final</th>
                                <th>Numero Actual</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($series as $serie)
                            <tr>
                                <td>{{$serie->id}}</td>
                                <td>{{$serie->prefijo}}
                                <td>{{$serie->inicial}}
                                <td>{{$serie->final}}
                                <td>{{$serie->actual}}
                                <td>{{$serie->estado}}
                                <td style="text-align: center;">
                                    <a href="{{ route('series.edit',$serie->id)}}"
                                       class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                       data-placement="top" title="Editar Serie"><i
                                            class="material-icons">mode_edit</i></a>
                                    <a href="{{ route('series.delete',$serie->id)}}"
                                       class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                       data-placement="top" title="Eliminar Serie"><i
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
