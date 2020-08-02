@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('admin.compras')}}">Compras</a></li>
    <li class="active"><a href="{{route('proveedores.index')}}">Proveedores</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    PROVEEDORES- LISTADO DE TODOS LAS PROVEEDORES DE LA NIKORERA.
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedores)
                            <tr>
                                <td>{{$proveedores->id}}</td>
                                <td>{{$proveedores->nombre}}
                                <td>{{$proveedores->created_at}}</td>
                                <td>{{$proveedores->updated_at}}</td>
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
