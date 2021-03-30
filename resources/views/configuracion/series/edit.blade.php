@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.configuracion')}}">Configuración</a></li>
        <li class="active"><a style="color:white" href="{{route('series.index')}}">Series</a></li>
        <li class="active"><a style="color:white" href="">Editado Serie</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE CONFIGURACIÓN - SERIES DE FACTURAS - EDITANDO SERIE. <small>Edite los datos en los campos de su elección y haga click en el boton Actualizar</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <h1 class="card-inside-title">DATOS DE LA SERIE</h1>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{route('series.update',$serie->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT" />
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Serie</label>
                                            <br/><input type="text" class="form-control" placeholder="Escriba el prefijo de la serie" name="prefijo" value="{{$serie->prefijo}}" required="required" />
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Numero inicial</label>
                                            <br/><input type="number" class="form-control" placeholder="Escriba el numero inicial de la serie" name="inicial" value="{{$serie->inicial}}" required="required" />
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Numero Final</label>
                                            <br/><input type="number" class="form-control" placeholder="Escriba el numero final de la serie" name="final" value="{{$serie->final}}" required="required" />
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Numero Final</label>
                                            <br/><input type="number" class="form-control" placeholder="Escriba el numero final de la serie" name="final" value="{{$serie->final}}" required="required" />
                                        </div>
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Estado</label>
                                            <select name="estado" class="form-control">
                                                @if($serie->estado == 'ACTIVO')
                                                    <option selected value="ACTIVO">ACTIVO</option>
                                                @else
                                                    <option value="ACTIVO">ACTIVO</option>
                                                @endif
                                                @if($serie->estado == 'INACTIVO')
                                                    <option selected value="INACTIVO">INACTIVO</option>
                                                @else
                                                    <option value="INACTIVO">INACTIVO</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br/><br/><a href="{{route('series.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                        <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
