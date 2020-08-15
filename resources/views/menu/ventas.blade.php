@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.ventas')}}">Ventas</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE LAS VENTAS REALIZADAS<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-black alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Gestione Clientes y las ventas realizadas.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_CLIENTES'))
                    <a href="{{route('clientes.index')}}" class="btn btn-lg bg-black  waves-effect">
                        <div>
                            <span><i class="material-icons">contacts</i></span>
                            <span>CLIENTES</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_FACTURAR'))
                    <a href="{{route('mfacturas.create')}}" class="btn bg-black btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">pages</i></span>
                            <span>FACTURAR</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
