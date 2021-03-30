@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb " style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color: white"href="{{route('clientes.index')}}">Clientes</a></li>
        <li class="active"><a style="color:white" href="{{route('clientes.show',$factura->cliente->id)}}">Facturas de {{$factura->cliente->nombres}}</a></li>
        <li class="active"><a style="color:white" href="">Facturas # {{$factura->serie.'-'.$factura->n_venta}}</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DETALLE DE LA FACTURA.
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
                            <th>Subtotal</th>
                            </thead>
                            <tbody id="productos">
                            <?php $total = 0?>
                            @foreach($factura->dfactura as $detalle)
                                <tr>
                                    <td>{{$detalle->producto_embalaje->codigo_de_barras}}</td>
                                    <td>{{$detalle->producto_embalaje->producto->nombre.'X'.$detalle->producto_embalaje->producto->presentacion}}</td>
                                    <td>{{$detalle->producto_embalaje->embalaje->descripcion}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>$ {{number_format($detalle->precio)}}</td>
                                    <td>$ {{number_format($detalle->cantidad*$detalle->precio)}}</td>
                                </tr>
                            @endforeach
                            @foreach(json_decode($factura->adicionales) as $adicional)
                                <tr>
                                    <td>{{$adicional->unicode}}</td>
                                    <td>{{$adicional->nombre}}</td>
                                    <td>{{$adicional->cantidad}}</td>
                                    <td>UNIDAD</td>
                                    <td>$ {{$adicional->precio_show}}</td>
                                    <td>$ {{number_format($adicional->total)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5"></td>
                                <td>$ {{number_format($factura->total)}}</td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
        @if($factura->modalidad_pago=='credito')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        LISTADO DE ABONOS.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped table-hover table-responsive table-condensed " width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Abonos</th>
                                <th>Medio de Pago</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($abonos as $abono)
                            <tr>
                                <td>{{number_format($abono->abono)}}</td>
                                <td>{{$abono->medio_pago}}</td>
                                <td>{{$abono->created_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                 columnDefs: [ { type: 'date', 'targets': [2] } ],
                "order": [[2, "desc" ]] // Sort by first column descending
            });
        });
    </script>
@endsection
