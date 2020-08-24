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
                        DATOS DE FACTURA - DEVOLUCIÓN <small>Ingrese los datos y haga click en el boton Consultar, para visualizar la factura a devolver.</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="row clearfix">
                        <form class="form-horizontal" style="width: 90%; margin: 0 auto;" method="GET" action="{{route('reporte.ventas')}}">
                            @csrf
                            <div class="col-md-12">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Fecha Inicial</label>
                                            <input type="date" name="fecha_inicial"  class="form-control" placeholder="Desde"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="exampleFormControlSelect1">Fecha Final</label>
                                            <input type="date" name="fecha_final"  class="form-control" placeholder="Hasta"/>
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
    </div>
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">Ventas Totales</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">
                        {{number_format($reporte['total_vendido'],2)}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">Numero de Ventas</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$reporte['numero_ventas']}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">Ganancia</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">
                        {{number_format($reporte['ganancia'],2)}}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">Margen de Ganancia</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">
                        {{$reporte['margen_ganancia'].'%'}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="header">
                    <h2>VENTAS POR FORMA DE PAGO</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <tbody>
                                @foreach($reporte['medios_pago'] as $medio)
                                     <tr>
                                         <td>{{strtoupper($medio->medio_pago)}}</td>
                                         <td>$ {{number_format($medio->total,2)}}</td>
                                     </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>ABONOS POR FORMA DE PAGO</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <tbody>
                            @foreach($reporte['abonos'] as $abono)
                                <tr>
                                    <td>{{strtoupper($abono->medio_pago)}}</td>
                                    <td>$ {{number_format($abono->total,2)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#tabla').DataTable();
        });
    </script>
@endsection
