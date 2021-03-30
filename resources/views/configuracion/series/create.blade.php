@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.configuracion')}}">Compras</a></li>
        <li class="active"><a style="color:white" href="{{route('series.index')}}">Series</a></li>
        <li class="active"><a style="color:white" href="">Creando nueva Serie</a></li>
    </ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE CONFIGURACIÓN - SERIES DE FACTURAS - EDITANDO SERIE. <small>Ingrese los datos y haga click en el boton Guardar.</small>
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
                        <form class="form-horizontal" method="POST" action="{{route('series.store')}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Serie</label>
                                        <br/><input type="text" class="form-control" placeholder="Escriba el prefijo de la serie" name="prefijo" required="required" />
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Numero Inicial</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba el numero inicial de la serie" name="inicial" required="required" />
                                    </div>
                                    <div class="form-line">
                                        <label for="exampleFormControlSelect1">Numero Final</label>
                                        <br/><input type="number" class="form-control" placeholder="Escriba el numero final de la serie" name="final" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('series.index')}}" class="btn bg-red waves-effect">Cancelar</a>
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
@endsection
