@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('descuentos.index')}}">Descuentos</a></li>
        <li class="active"><a style="color:white" href="">Creando nuevo Descuento</a></li>
    </ol>
@endsection
@section('style')
    <style>
        .form-line {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE VENTAS - DESCUENTOS EN EL SISTEMA. <small>Ingrese los datos y haga click en el boton Guardar.</small>
                </h2>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="row clearfix">
                    <div class="col-md-12" style="margin-bottom: 0;">
                        <form id="form" action="{{route('descuentos.store')}}" method="POST">
                            @csrf
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                            <label for="">Fecha Inicio</label>
                                            <input type="date" id="datePicker" name="fecha_inicio" class="form-control" value="{{date('Y-m-d')}}" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Fecha Final</label>
                                        <input type="date" id="datePicker" name="fecha_fin" class="form-control" value="{{date('Y-m-d')}}"required="required">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-4" style="display: flex">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Codigo de Barras</label>
                                            <input type="hidden" name="producto_embalaje_id" id="producto_embalaje">
                                            <input type="text" class="form-control" id="codigo" onkeypress="buscarProducto(event)" onblur="search()" placeholder="scanee o ingrese el codigo del producto" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Cantidad Destinda</label>
                                            <br/><input id="cantidad" type="number" class="form-control" placeholder="Cantidad de la promoción" name="cantidad_destinada" required="required"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Precio</label>
                                            <br/><input type="text" id="costo_promedio" class="form-control" min="1" placeholder="precio de la promoción" name="valor" required="required"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <br/><br/><a href="{{route('descuentos.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#verification_code">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.permisions')
@endsection
@section('script')
    <script src="{{asset('js/number_format.js')}}"></script>
    <script>
        function search() {
            const  codigo = $('#codigo').val();
            $.ajax({
                type: 'GET',
                url: '{{url('almacen/producto/search')}}/'+codigo,
            }).done(function (msg) {
                if(msg.status == 'ok'){
                    $('#producto_embalaje').val(msg.producto.unicode);
                    //document.getElementById('costo_promedio').value = msg.producto.costo_promedio;
                    $('#cantidad').focus();
                }else{
                    notify('Atención', 'El producto con el codigo ' + $('#cogigo').val() +' no ha sido registrado.!', 'warning');
                    $('#cogigo').val('');
                }
            });
        }
        function buscarProducto(event){
            if(event.keyCode == 13){
                event.preventDefault();
                search();
            }
        }

    </script>
@endsection
