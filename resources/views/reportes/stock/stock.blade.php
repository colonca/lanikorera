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
                <h2>
                    STOCK
                </h2>
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
                                <td>{{$item->stock}}
                                <td>{{$item->costo_promedio}}</td>
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
