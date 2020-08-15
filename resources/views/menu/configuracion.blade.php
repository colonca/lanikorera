@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-black" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.configuracion')}}">Configuración</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    CONFIGURACIÓN <small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Gestione las configuración de las series de las facturas.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_SERIES'))
                        <a href="{{route('series.index')}}" class="btn bg-black btn-lg  waves-effect">
                            <div>
                                <span><i class="material-icons">bubble_chart</i></span>
                                <span>SERIES</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
