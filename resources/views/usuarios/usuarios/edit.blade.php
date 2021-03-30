@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.usuarios')}}">Usuarios</a></li>
    <li class="active"><a style="color:white">Editar/Eliminar Usuario</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    USUARIOS DEL SISTEMA - EDITAR/ELIMINAR USUARIO
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
                <h1 class="card-inside-title">DATOS DEL USUARIO</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('usuario.update',$user->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" value="{{$user->identificacion}}" class="form-control" placeholder="Escriba el número de identificación del usuario, con éste tendrá acceso al sistema" name="identificacion" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" value="{{$user->nombres}}" class="form-control" placeholder="Escriba los nombres del usuario" name="nombres" id="txt_nombres" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" value="{{$user->apellidos}}" class="form-control" placeholder="Escriba los apellidos del usuario" name="apellidos" id="txt_apellidos" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="email" value="{{$user->email}}" class="form-control" placeholder="Escriba el correo electrónico del usuario" name="email" id="txt_email" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><label>Estado del Usuario</label>
                                        <br/><select class="form-control show-tick select2" name="estado" placeholder="-- Seleccione Estado del Usuario --" required="">
                                            @if($user->estado=='ACTIVO')
                                            <option value="ACTIVO" selected="">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                            @else
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO" selected="">INACTIVO</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Seleccione los Grupos o Roles de Usuarios</label>
                                        <br/><select class="form-control show-tick select2" name="grupos[]" placeholder="Seleccione los Grupos o Roles de Usuarios" required="" multiple="">
                                            @foreach($grupos as $key=>$value)
                                            <?php
                                            $existe = false;
                                            ?>
                                            @foreach($user->grupousuarios as $m)
                                            @if($m->id==$key)
                                            <?php
                                            $existe = true;
                                            ?>
                                            @endif
                                            @endforeach
                                            @if($existe)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                            @else
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br/><br/><a href="{{route('admin.usuarios')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <button class="btn bg-green waves-effect" type="submit">Guardar</button>
                                    <a href="{{ route('usuario.delete',$user->id)}}" class="btn bg-red waves-effect">Eliminar Usuario</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    USUARIOS DEL SISTEMA - CAMBIAR CONTRASEÑA
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
                <h1 class="card-inside-title">DATOS DEL USUARIO</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form form-horizontal" role="form" method="POST" action="{{route('usuario.cambiarPass')}}">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" name="identificacion2" value="{{$user->identificacion}}" class="form-control" readonly="" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Escriba la Nueva Contraseña</label>
                                        <br/><input type="password" name="pass1" placeholder="Mínimo 6 caracteres" class="form-control" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Vuelva a Escribir La Nueva Contraseña</label>
                                        <br/><input type="password" name="pass2" placeholder="Mínimo 6 caracteres" class="form-control" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar</button>
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
                <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS USUARIOS</h4>
            </div>
            <div class="modal-body">
                <strong>Edite ó elimine un usuario del sistema. Además, puede cambiar la contraseña.</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.select2').select2();
</script>
@endsection
