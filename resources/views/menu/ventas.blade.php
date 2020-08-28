@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE VENTAS <small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
                    <button  style="color: black" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong style="color: black">Detalles: </strong> <span style="color: black">Gestione Clientes, Facturas, Devoluciones, Descuentos y Deudas.</span>
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_CLIENTES'))
                    <a href="{{route('clientes.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                        <div>
                            <span><i class="material-icons">contacts</i></span>
                            <span>CLIENTES</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_FACTURAR'))
                        <a href="{{route('mfacturas.create')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">fact_check</i></span>
                                <span>FACTURAR</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_FACTURAS'))
                        <a href="{{route('mfacturas.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">fact_check</i></span>
                                <span>FACTURAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_DEVOLUCIONES'))
                        <a href="{{route('devoluciones.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="fas fa-exchange-alt"></i></span>
                                <span>DEVOLUCIONES</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_DESCUENTOS'))
                        <a href="{{route('descuentos.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="fas fa-piggy-bank"></i></span>
                                <span>DESCUENTOS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_DEUDAS'))

                        <a href="{{route('deuda.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="fas fa-bomb"></i></span>
                                <span>DEUDAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
