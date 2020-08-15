@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px; background-color: black">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.compras')}}">Compras</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                   DATO DE LAS COMPRAS<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-black alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Gestione los proveedores, y compras realizadas.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_PROVEEDORES'))
                    <a href="{{route('proveedores.index')}}" class="btn btn-lg bg-black  waves-effect">
                        <div>
                            <span><i class="material-icons">connect_without_contact</i></span>
                            <span>PROVEEDORES</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_ENTRADA-DE-ALMACEN'))
                        <a href="{{route('compras.create')}}" class="btn bg-black btn-lg  waves-effect">
                            <div>
                                <span><i class="material-icons">pages</i></span>
                                <span>ENTRADA DE ALMACEN</span>
                                <span class="ink animate"></span>
                            </div>
                        </a>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
