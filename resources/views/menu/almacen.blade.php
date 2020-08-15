@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-bg-black" style="margin-bottom: 30px;">
    <li><a href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a href="{{route('admin.almacen')}}">Almacen</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DEL ALMACEN<small>MENÚ</small>
                </h2>
            </div>
            <div class="body">
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Detalles: </strong> Gestione las Marcas, Categorias, Embalajes de los productos como también las bodegas de la empresa.
                </div>
                <div class="button-demo">
                    @if(session()->exists('PAG_MARCAS'))
                    <a href="{{route('marcas.index')}}" class="btn bg-black btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">bubble_chart</i></span>
                            <span>MARCAS</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_CATEGORIAS'))
                    <a href="{{route('categorias.index')}}" class="btn bg-black  btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">category</i></span>
                            <span>CATEGORÍAS</span>
                            <span class="ink animate"></span></div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_SUBCATEGORIAS'))
                        <a href="{{route('subcategorias.index')}}" class="btn bg-black  btn-lg  waves-effect">
                            <div>
                                <span><i class="far fa-caret-square-up"></i></span>
                                <span>SUBCATEGORÍAS</span>
                                <span class="ink animate"></span></div>
                        </a>
                    @endif
                    @if(session()->exists('PAG_EMBALAJES'))
                    <a href="{{route('embalajes.index')}}" class="btn bg-black  btn-lg  waves-effect">
                        <div>
                            <span><i class="material-icons">account_balance_wallet</i></span>
                            <span>EMBALAJES</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_BODEGAS'))
                    <a href="{{route('bodegas.index')}}" class="btn bg-black  btn-lg waves-effect">
                        <div>
                            <span><i class="material-icons">store</i></span>
                            <span>BODEGAS</span>
                            <span class="ink animate"></span>
                        </div>
                    </a>
                    @endif
                    @if(session()->exists('PAG_PRODUCTOS'))
                            <a href="{{route('productos.index')}}" class="btn bg-black  btn-lg waves-effect">
                                <div>
                                    <span><i class="fas fa-wine-bottle"></i></span>
                                    <span>PRODUCTOS</span>
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
