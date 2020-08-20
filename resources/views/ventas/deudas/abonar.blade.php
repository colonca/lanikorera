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
            <form class="form-horizontal" method="POST" action="{{route('clientes.update', $clientes->id)}}">
                @csrf
                <input name="_method" type="hidden" value="PUT" />
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line" >
                            <label for="exampleFormControlSelect1">Identidicación</label>
                            <br/><input type="number" class="form-control" placeholder="Escriba la cedula del cliente" value="{{$clientes->identificacion}}" name="identificacion" required="required" />
                        </div>
                        <div class="form-line">
                            <label for="exampleFormControlSelect1">Nombres</label>
                            <br/><input type="text" class="form-control" placeholder="Escriba nombre del cliente" value="{{$clientes->nombres}}" name="nombres"required="required"/>
                        </div>
                        <div class="form-line">
                            <label for="exampleFormControlSelect1">Apellidos</label>
                            <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente" value="{{$clientes->apellidos}}" name="apellidos" required="required"/>
                        </div>
                        <div class="form-line">
                            <label for="exampleFormControlSelect1">Telefono</label>
                            <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente" value="{{$clientes->telefono}}" name="telefono" required="required"/>
                        </div>
                        <div class="form-line">
                            <label for="exampleFormControlSelect1">Email</label>
                            <br/><input type="email" class="form-control" placeholder="email@example.com" value="{{$clientes->email}}" name="email" required="required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <br/><br/><a href="{{route('clientes.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                        <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DEUDAS- LISTADO DE DEUDAS.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Identificacion</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Total</th>
                                <th>abonos</th>
                                <th>Restante</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->identificacion}}</td>
                                    <td>{{$cliente->nombres}}</td>
                                    <td>{{$cliente->apellidos}}</td>
                                    <td>{{$cliente->total}}</td>
                                    <td>{{$cliente->abonos}}</td>
                                    <td>{{$cliente->resta}}</td>
                                    <td style="text-align: center;">

                                        <a href="{{ route('deuda.show',$cliente->id)}}"

                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Editar abono"><i
                                                class="material-icons">mode_edit</i></a>
                                    </td>
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
