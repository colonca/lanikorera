@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;ackground-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>
                        ACTUALIZAR ABONOS
                    </h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" method="POST" >
                        @csrf
                        <input name="_method" type="hidden" value="PUT" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line" >
                                    <label for="exampleFormControlSelect1">Id factura</label>
                                    <br/><input type="number" class="form-control"  name="identificacion" required="required" disabled />
                                </div>
                                <div class="form-line">
                                    <label for="exampleFormControlSelect1">Nombres</label>
                                    <br/><input type="text" class="form-control" placeholder="Escriba nombre del cliente"  name="nombres"required="required" disabled/>
                                </div>
                                <div class="form-line">
                                    <label for="exampleFormControlSelect1">Apellidos</label>
                                    <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente"  name="apellidos" required="required" disabled/>
                                </div>
                                <div class="form-line">
                                    <label for="exampleFormControlSelect1">Total</label>
                                    <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente"  name="telefono" required="required" disabled/>
                                </div>
                                <div class="form-line">
                                    <label for="exampleFormControlSelect1">Valor</label>
                                    <br/><input type="number" class="form-control" placeholder="0.00"  name="valor" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>
                        DEUDAS- LISTADO DE ABONOS.
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="tabla" class="table table-bordered table-striped table-hover table-responsive table-condensed dataTable js-exportable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Abonos</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>

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
