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
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Gestione Clientes y las ventas realizadas.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_CLIENTES'))
                    <a href="{{route('clientes.index')}}" class="btn btn-primary btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">contacts</i></span>
                            <span>CLIENTES</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_CATEGORIAS'))
                    <a href="{{route('categorias.index')}}" class="btn bg-deep-orange btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">pages</i></span>
                            <span>CATEGORÍAS</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_EMBALAJES'))
                    <a href="{{route('embalajes.index')}}" class="btn bg-green btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">group</i></span>
                            <span>EMBALAJES</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_BODEGAS'))
                    <a href="{{route('bodegas.index')}}" class="btn bg-brown btn-lg waves-effect">
                        <div>
                            <span><i class="material-icons">group</i></span>
                            <span>BODEGAS</span>
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