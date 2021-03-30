@extends('layouts.admin')
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li><a style="color:white" href="{{route('admin.reportes')}}">Reportes</a></li>
    <li class="active"><a style="color:white" >Salidas</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                        REPORTES - SALIDAS
                    </div>
                    <div class="body">
                        <div class="col-md-12">
                            @component('layouts.errors')
                            @endcomponent
                        </div>
                        <div class="row clearfix">
                            <form class="form-horizontal" style="width: 90%; margin: 0 auto;" method="GET" action="{{route('reporte.salidas')}}">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="exampleFormControlSelect1">Fecha Inicial</label>
                                                <input type="date" name="fecha_inicial"  class="form-control" placeholder="Desde" value="{{isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : date('Y-m-d')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="exampleFormControlSelect1">Fecha Final</label>
                                                <input type="date" name="fecha_final"  class="form-control" placeholder="Hasta" value="{{isset($_GET['fecha_final']) ? $_GET['fecha_final'] : date('Y-m-d')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn waves-effect btn-block" style="background-color: #38383A; color:white;">CONSULTAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Unidades</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($salidas as $item)
                            <tr>
                                <td>{{$item->nombre.' x '.$item->presentacion}}
                                <td>{{$item->cantidad}}</td>
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
