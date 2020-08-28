@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.almacen')}}">Almacen</a></li>
        <li class="active"><a style="color:white" href="{{route('subcategorias.index')}}">Subcategoría</a></li>
        <li class="active"><a style="color:white" href="">Editado Subcategoría {{$subcategoria->nombre}}</a></li>
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
                    DATOS DEL ALMACEN - SUBCATEGORÍAS EN EL SISTEMA - EDITANDO SUBCATEORÍA.<small>Edite los datos en los campos de su elección y haga click en el boton Actualizar</small>
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <h1 class="card-inside-title">DATOS DE LA SUBCATEGORÍA</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form class="form-horizontal" method="POST" action="{{route('subcategorias.update',$subcategoria->id)}}">
                            @csrf
                            <input name="_method" type="hidden" value="PUT" />
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Categoria</label>
                                        <select name="categoria_id" id="categorias_id" class="form-control">
                                            @foreach($categorias as $categoria)
                                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Nombre</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba el nombre de la subcategoria" value="{{$subcategoria->nombre}}" name="nombre" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('subcategorias.index')}}" class="btn bg-red waves-effect">Cancelar</a>
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
