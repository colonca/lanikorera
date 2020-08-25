@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" href="{{route('admin.compras')}}">Compras</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                   DATOS DE COMPRAS<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
                    <button style="color: black" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong style="color: black">Detalles: </strong><span style="color: black">Gestione los proveedores, y entradas de almacen.</span>
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_PROVEEDORES'))
                    <a href="{{route('proveedores.index')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                        <div>
                            <span><i class="material-icons">connect_without_contact</i></span>
                            <span>PROVEEDORES</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_ENTRADA-DE-ALMACEN'))
                        <a href="{{route('compras.create')}}" class="btn btn-lg  waves-effect" style="background-color: #38383A; color:white;">
                            <div>
                                <span><i class="material-icons">shopping_bag</i></span>
                                <span>ENTRADA DE ALMACEN</span>
                                <span class="ink animate"></span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
