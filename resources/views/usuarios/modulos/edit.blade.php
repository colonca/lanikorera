@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.usuarios')}}">Usuarios</a></li>
    <li><a style="color:white" href="{{route('modulo.index')}}">Módulos del Sistema</a></li>
    <li class="active"><a style="color:white" >Editar Módulo</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    USUARIOS DEL SISTEMA - MÓDULOS GENERALES DEL SISTEMA
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <h1 class="card-inside-title">EDITAR DATOS DEL MÓDULO: {{$modulo->nombre}}</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('modulo.update',$modulo->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" value="{{$modulo->nombre}}" placeholder="Escriba el nombre del módulo u opción de menú" name="nombre" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control"  value="{{$modulo->descripcion}}" placeholder="Descripción del módulo (Opcional)" name="descripcion"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('modulo.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-brown">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS MÓDULOS</h4>
            </div>
            <div class="modal-body">
                <strong>Nota: </strong> No modifique los nombres de los módulos ya creados ya que puede ocasionar fallas en el sistema. Hágalo si y solo si el desarrollador indica la necesidad de la operación. El nombre del módulo debe iniciar con "MOD_" seguido del nombre que usted desee.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
