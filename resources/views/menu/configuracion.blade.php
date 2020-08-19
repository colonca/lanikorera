@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" href="{{route('admin.configuracion')}}">Configuración</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE CONFIGURACIÓN <small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
                    <button style="color: black" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong style="color: black">Detalles: </strong> <span style="color: black">Gestione las configuración de las series de las facturas.</span>
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_SERIES'))
                        <a href="{{route('series.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
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
