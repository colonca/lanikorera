@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.almacen')}}">Almacen</a></li>
        <li class="active"><a style="color:white" href="{{route('embalajes.index')}}">Embalajes</a></li>
        <li class="active"><a style="color:white" href="">Editado Embalaje {{$embalaje->descripcion}}</a></li>
    </ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                   DATOS DEL ALMACEN - EMBALAJES DE LOS PRODUCTO EN EL SISTEMA - EDITANDO EMBALAJE.<small>Edite los datos en los campos de su elección y haga click en el boton Actualizar</small>
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <h1 class="card-inside-title">DATOS DEL EMBALAJE</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('embalajes.update',$embalaje->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Nombre</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba el nombre del embalaje" value="{{$embalaje->descripcion}}" name="descripcion" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('embalajes.index')}}" class="btn bg-red waves-effect">Cancelar</a>
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
