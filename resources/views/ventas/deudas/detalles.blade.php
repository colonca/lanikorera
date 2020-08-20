@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a href="{{route('deuda.index')}}">Deudas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DEUDAS- LISTADO DE PRODUCTOS DE LA TIENDA.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-info" >
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Embalaje</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                            </thead>
                            <tbody id="productos">
                            <?php $total = 0?>
                            @foreach($factura->dfactura as $detalle)
                                <tr>
                                    <td>{{$detalle->producto_embalaje->codigo_de_barras}}</td>
                                    <td>{{$detalle->producto_embalaje->producto->nombre.'X'.$detalle->producto_embalaje->producto->presentacion}}</td>
                                    <td>{{$detalle->producto_embalaje->embalaje->descripcion}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>$ {{$detalle->precio}}</td>
                                    <td>$ {{$detalle->cantidad*$detalle->precio}}</td>
                                </tr>
                            @endforeach
                            @foreach($factura->adicionales as $adicional)
                                <tr>
                                    <td>{{$adicional->id}}</td>
                                    <td>{{$adicional->nombre}}</td>
                                    <td>{{$adicional->cantidad}}</td>
                                    <td>UNIDAD</td>
                                    <td>$ {{$adicional->precio_venta}}</td>
                                    <td>$ {{$adicional->cantidad*$adicional->precio_venta}}</td>
                                </tr>
                            @endforeach
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#tabla').DataTable();
        });
    </script>
@endsection
