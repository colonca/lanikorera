@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.ventas')}}">Ventas</a></li>
    </ol>
@endsection
@section('content')
    <div class="row clearfix">
           <div class="col-md-6">
               <div class="card">
                   <div class="header">
                       <h2>
                           DEUDA- ACTUALIZAR.
                       </h2>
                   </div>
                   <div class="body">
                       <div class="table-responsive">
                           <form class="" method="POST" >
                               @csrf
                               <input name="_method" type="hidden" value="PUT" />
                               <div class="col-md-12">
                                   @foreach($facturas as $factura)
                                       <div class="form-group">
                                           <div class="form-line" >
                                               <label for="exampleFormControlSelect1">Id factura</label>
                                               <br/><input type="text" class="form-control"  placeholder="Id factura" value="{{$factura->serie.'-'.$factura->n_venta}}" name="idFactura" required="required" disabled />
                                           </div>
                                           <div class="form-line">
                                               <label for="exampleFormControlSelect1">Nombres</label>
                                               <br/><input type="text" class="form-control" placeholder="Nombres del cliente"  value="{{$factura->nombres}}" name="nombres"required="required" disabled/>
                                           </div>
                                           <div class="form-line">
                                               <label for="exampleFormControlSelect1">Apellidos</label>
                                               <br/><input type="text" class="form-control" placeholder="apellidos del cliente"  value="{{$factura->apellidos}}"name="apellidos" required="required" disabled/>
                                           </div>
                                           <div class="form-line">
                                               <label for="exampleFormControlSelect1">Total</label>
                                               <br/><input type="number" class="form-control" placeholder="Total de l factura"  value="{{$factura->total}}"name="total" required="required" disabled/>
                                           </div>
                                           <div class="form-line">
                                               <label for="exampleFormControlSelect1">Valor</label>
                                               <br/><input type="number" class="form-control" placeholder="0.00"  name="valor" required="required" />
                                           </div>
                                       </div>
                                   @endforeach
                                   <div class="form-group">
                                       <button class="btn bg-green waves-effect" type="submit">Actualizar</button>
                                   </div>
                               </div>
                           </form>
                       </div>
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
                                @foreach($abonos as $abono)
                                    <tr>
                                        <td>{{$abono->abono}}</td>
                                        <td>{{$abono->created_at}}</td>
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
