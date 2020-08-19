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
                    <strong style="color: black">Detalles: </strong><span style="color: black">Gestione los proveedores, y compras realizadas.</span>
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
