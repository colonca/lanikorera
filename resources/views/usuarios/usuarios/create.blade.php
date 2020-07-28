@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li><a href="{{route('admin.usuarios')}}">Usuarios</a></li>
    <li class="active"><a>Crear Usuario</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    USUARIOS DEL SISTEMA - CREAR USUARIO
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
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Escriba la identificación a consultar" name="id" id="id" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn bg-brown btn-block waves-effect" disabled="disabled">Traer Persona</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('usuario.store')}}">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" placeholder="Escriba el número de identificación del usuario, con éste tendrá acceso al sistema" name="identificacion" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" placeholder="Escriba los nombres del usuario" name="nombres" id="txt_nombres" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="text" class="form-control" placeholder="Escriba los apellidos del usuario" name="apellidos" id="txt_apellidos" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><input type="email" class="form-control" placeholder="Escriba el correo electrónico del usuario" name="email" id="txt_email" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="form-line">
                                        <br/><label>Estado del Usuario</label>
                                        <br/><select class="form-control show-tick select2" name="estado" placeholder="-- Seleccione Estado del Usuario --" required="">
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Seleccione los Grupos o Roles de Usuarios</label>
                                        <br/><select class="form-control show-tick select2" name="grupos[]" placeholder="Seleccione los Grupos o Roles de Usuarios" required="" multiple="">
                                            @foreach($grupos as $key=>$value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><br/>
                                    <div class="form-line">
                                        <br/><input type="password" class="form-control" placeholder="Contraseña del Usuario" name="password" required="required" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br/><br/><a href="{{route('admin.usuarios')}}" class="btn bg-red waves-effect">Cancelar</a>
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
                <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS USUARIOS</h4>
            </div>
            <div class="modal-body">
                <strong>Agregue un usuario al sistema y registre su/sus roles de acceso</strong>. Puede crear un usuario llenando todos los campos, ó partir de las personas generales ó feligreses de la iglesia.
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