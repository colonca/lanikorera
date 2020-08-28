@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.almacen')}}">Almacen</a></li>
    <li class="active"><a style="color:white" href="{{route('subcategorias.index')}}">Subcategorías</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DEL ALMACEN - SUBCATEGORÍAS EN EL SISTEMA.<small>Haga clic en el botón de 3 puntos de la derecha de este título para agregar un nuevo registro.</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="{{ route('subcategorias.create') }}">Agregar Nueva Subcategoría</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategorias as $subcategoria)
                            <tr>
                                <td>{{$subcategoria->categoria->nombre}}</td>
                                <td>{{$subcategoria->nombre}}
                                <td style="text-align: center;">
                                    <a href="{{ route('subcategorias.edit',$subcategoria->id)}}"
                                       class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                       data-placement="top" title="Editar Subcategoria"><i
                                            class="material-icons">mode_edit</i></a>
                                    <a href="{{ route('subcategorias.delete',$subcategoria->id)}}"
                                       class="btn bg-red waves-effect btn-xs" data-toggle="tooltip"
                                       data-placement="top" title="Eliminar Subcategoria"><i
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
