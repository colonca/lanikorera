@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb " style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color: white;" href="{{route('deuda.index')}}">Deudas</a></li>
        <li class="active"><a style="color: white" >Facturas en Deuda</a></li>
        <li class="active"><a style="color: white" >Abonar</a></li>
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
                           <form class="" method="POST" action="{{route('deuda.update', $factura->id)}}">
                               @csrf
                               <input name="_method" type="hidden" value="PUT" />
                               <div class="col-md-12">

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
                                               <label for="exampleFormControlSelect1">Total</label>
                                               <br/><input type="number" class="form-control" placeholder="Total de l factura"  value="{{$factura->total}}" name="total" required="required" disabled/>
                                           </div>
                                           <div class="form-line">
                                               <label for="exampleFormControlSelect1">Medio de Pago</label>
                                               <br/>
                                               <select name="medio_pago" id="" class="form-control">
                                                   <option value="efectivo">Efectivo</option>
                                                   <option value="datafono">Datafono</option>
                                                   <option value="transferencia">Transferencia</option>
                                               </select>
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
                                <th>Medio de Pago</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($abonos as $abono)
                                    <tr>
                                        <td>{{$abono->abono}}</td>
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
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#tabla').DataTable();
        });
    </script>
@endsection
