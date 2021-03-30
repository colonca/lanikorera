@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li class="active"><a style="color:white" href="#">Cambiar Contraseña</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        CAMBIAR CONTRASEÑA
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
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('usuario.cambiarcontrasenia')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Escriba Su Contraseña Actual</label>
                                            <br/><input type="password" class="form-control"
                                                        name="pass0" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Escriba la Nueva Contraseña</label>
                                            <br/><input type="password" name="pass1" placeholder="Mínimo 6 caracteres"
                                                        class="form-control" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Vuelva a Escribir La Nueva Contraseña</label>
                                            <br/><input type="password" name="pass2" placeholder="Mínimo 6 caracteres"
                                                        class="form-control" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('inicio')}}" class="btn bg-red waves-effect">Cancelar</a>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS PROGRAMAS DE APOYO</h4>
                </div>
                <div class="modal-body">
                    Cambie la contraseña para el inicio de sesión.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection
