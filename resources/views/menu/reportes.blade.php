@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" href="{{route('admin.reportes')}}">Reportes</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    REPORTES<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
                    <button type="button" style="color: black" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong style="color: black">Detalles: </strong > <span style="color: black">Revise el stock de productos y el reporte de ventas fitrado por fecha.</span>
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_STOCK'))
                    <a href="{{route('reporte.stock')}}" class="btn  btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                        <div>
                            <span><i class="fas fa-warehouse"></i></span>
                            <span>STOCK</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_REPORTE-VENTAS'))
                        <a href="{{route('reporte.ventas')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="fas fa-hand-holding-usd"></i></span>
                                <span>VENTAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                        @if(session()->exists('PAG_REPORTE-LISTA'))
                            <a href="{{route('reporte.lista_precios')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                                <div>
                                    <i class="fas fa-comment-dollar"></i>
                                    <span>LISTA DE PRECIOS</span>
                                    <span class="ink animate"></span></div>
                            </a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
