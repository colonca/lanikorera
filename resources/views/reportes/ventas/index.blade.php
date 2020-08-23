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
                                         <td>{{$medio->medio_pago}}</td>
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
                    <h2>BROWSER USAGE</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div id="donut_chart" class="dashboard-donut-chart"><svg height="265" version="1.1" width="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.65625px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#e91e63" d="M135,214.16666666666669A81.66666666666667,81.66666666666667,0,0,0,197.36598314293147,79.77497187236375" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#e91e63" stroke="#ffffff" d="M135,217.16666666666669A84.66666666666667,84.66666666666667,0,0,0,199.65697844205954,77.83813410440976L228.5489747143972,53.41245780854564A122.5,122.5,0,0,1,135,255Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#00bcd4" d="M197.36598314293147,79.77497187236375A81.66666666666667,81.66666666666667,0,0,0,66.93689880580898,87.36842900724861" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#00bcd4" stroke="#ffffff" d="M199.65697844205954,77.83813410440976A84.66666666666667,84.66666666666667,0,0,0,64.4366216190836,85.71053456261693L37.07247685325579,67.56580091859239A117.5,117.5,0,0,1,224.73064921585035,56.64052075513561Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#ff9800" d="M66.93689880580898,87.36842900724861A81.66666666666667,81.66666666666667,0,0,0,65.44216513257356,175.29196248129173" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#ff9800" stroke="#ffffff" d="M64.4366216190836,85.71053456261693A84.66666666666667,84.66666666666667,0,0,0,62.88697936193341,176.86391212346163L34.92189064992728,194.06802765165443A117.5,117.5,0,0,1,37.07247685325579,67.56580091859239Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#009688" d="M65.44216513257356,175.29196248129173A81.66666666666667,81.66666666666667,0,0,0,115.52090387726372,211.80957860615354" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#009688" stroke="#ffffff" d="M62.88697936193341,176.86391212346163A84.66666666666667,84.66666666666667,0,0,0,114.80534524418361,214.72299169780814L106.97395353769576,246.60867942313925A117.5,117.5,0,0,1,34.92189064992728,194.06802765165443Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#607d8b" d="M115.52090387726372,211.80957860615354A81.66666666666667,81.66666666666667,0,0,0,134.9743436604178,214.16666263657822" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#607d8b" stroke="#ffffff" d="M114.80534524418361,214.72299169780814A84.66666666666667,84.66666666666667,0,0,0,134.97340118263722,217.1666624885342L134.96308628692765,249.99999420160748A117.5,117.5,0,0,1,106.97395353769576,246.60867942313925Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="135" y="122.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(2.402,0,0,2.402,-189.0237,-183.6569)" stroke-width="0.41632653061224484"><tspan dy="5.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Chrome</tspan></text><text x="135" y="142.5" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1.7014,0,0,1.7014,-94.5286,-94.3368)" stroke-width="0.5877551020408163"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">37%</tspan></text></svg></div>
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
