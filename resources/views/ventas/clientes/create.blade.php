@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a href="{{route('clientes.index')}}">Cleintess</a></li>
        <li class="active"><a href="">Creando un nuevo cliente</a></li>
    </ol>
@endsection
@section('style')
    <style>
        .form-line {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    CLIENTES DE LA NIKORERA.
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
                <h1 class="card-inside-title">DATOS DEL CLIENTE</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('clientes.store')}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line" >
                                        <label for="exampleFormControlSelect1">Identidicación</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba la cedula del cliente" name="identificacion" required="required" />
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Nombres</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba nombre del cliente" name="nombres"required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Apellidos</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente" name="apellidos" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Telefono</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente" name="telefono" required="required"/>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Email</label>
                                        <br/><input type="email" class="form-control" placeholder="email@example.com" name="email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('clientes.index')}}" class="btn bg-red waves-effect">Cancelar</a>
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
                <strong>Agregue nuevos clientes,</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
