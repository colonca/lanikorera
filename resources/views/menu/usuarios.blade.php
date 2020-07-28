@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.usuarios')}}">Usuarios</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    USUARIOS DEL SISTEMA<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Agregue usuarios al sistema y administre sus privilegios, gestione los usuarios, configure los grupos de usuarios, así como también los módulos del sistema, entre otras tareas.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_MODULOS'))
                    <a href="{{route('modulo.index')}}" class="btn btn-primary btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">view_module</i></span>
                            <span>MÓDULOS DEL SISTEMA</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_PAGINAS'))
                    <a href="{{route('pagina.index')}}" class="btn bg-deep-orange btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">pages</i></span>
                            <span>PÁGINAS DEL SISTEMA</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_GRUPOS-ROLES'))
                    <a href="{{route('grupousuario.index')}}" class="btn bg-green btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">group</i></span>
                            <span>GRUPOS O ROLES DE USUARIOS</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_PRIVILEGIOS'))
                    <a href="{{route('grupousuario.privilegios')}}" class="btn bg-brown btn-lg waves-effect">
                        <div>
                            <span><i class="material-icons">desktop_access_disabled</i></span>
                            <span>PRIVILÉGIOS A PÁGINAS</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_USUARIOS'))
                    <a href="{{route('usuario.index')}}" class="btn bg-teal btn-lg  waves-effect" data-toggle="tooltip" data-placement="top" title="Tenga en cuenta que al cargar gran cantidad de registros puede hacer que el navegador se bloquee y deba esperar a que este cargue todos los registros de la base de datos para continuar la navegación.">
                        <div>
                            <span><i class="material-icons">list</i></span>
                            <span>LISTAR TODOS LOS USUARIOS</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_USUARIO-MANUAL'))
                    <a href="{{route('usuario.create')}}" class="btn bg-red  btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">book</i></span>
                            <span>USUARIO MANUAL</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_AUTOMATICO'))
                    <a class="btn bg-red  btn-lg  waves-effect" disabled='disabled'>
                        <div>
                            <span><i class="material-icons">face</i></span>
                            <span>USUARIO AUTOMATICO</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(session()->exists('PAG_OPERACIONES-USUARIO'))
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    MODIFICACIÓN Y ELIMINACIÓN DE USUARIOS
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <form class="form-horizontal" method="POST" action="{{route('usuario.operaciones')}}" name="form-privilegios" id="form-privilegios">
                        @csrf
                        <div class="col-md-12">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="id" class="form-control" placeholder="Escriba la identificación a consultar" name="id"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn bg-brown waves-effect btn-block">CONSULTAR USUARIO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
