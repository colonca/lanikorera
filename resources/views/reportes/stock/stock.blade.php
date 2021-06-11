@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.reportes')}}">Reportes</a></li>
    <li class="active"><a style="color:white" >Stock</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                        REPORTES - STOCK
                    </div>
                    @if(session('ROL') === 'ADMINISTRADOR')
                        <div class="col-lg-4 col-md-2 col-sm-6 col-xs-6">
                            <div class="info-box bg-cyan hover-expand-effect">
                                <div class="icon">
                                    <i class="fas fa-search-dollar"></i>
                                </div>
                                <div class="content">
                                    <div class="text">Valor del Stock</div>
                                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                                        {{number_format($stock)}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock Mínimo</th>
                                <th>Stock Actual</th>
                                <th>Costo Unitario Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($inventario as $item)
                            <tr>
                                <td>{{$item->producto}}
                                <td>{{$item->stock_minimo}}
                                @if($item->stock < $item->stock_minimo)
                                    <td class="bg-danger">{{$item->stock}}</td>
                                @elseif($item->stock > $item->stock_minimo && $item->stock <= intval($item->stock_maximo / 2))
                                    <td class="bg-warning">{{$item->stock}}</td>
                                @else
                                    <td class="bg-success">{{$item->stock}}</td>
                                @endif
                                <td>$ {{number_format($item->costo_promedio)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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
