@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white"  href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="">Nueva Factura</a></li>
    </ol>
@endsection
@section('style')
    <style>
        /* Center the loader */
        #loader {
            display: block;
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 100000;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        #myDiv {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: black;
            opacity: 0.8;
            z-index: 1000;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from { bottom:-100px; opacity:0 }
            to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom {
            from{ bottom:-100px; opacity:0 }
            to{ bottom:0; opacity:1 }
        }


    </style>
@endsection
@section('content')

<livewire:facturas.factura/>
<!-- Modal -->
<div class="modal fade" id="Mcreate" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-cliente">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="exampleFormControlSelect1">Nombres</label>
                                <br/><input type="text" id="nombres" class="form-control" placeholder="Escriba nombre del cliente" name="nombres"required="required"/>
                            </div>
                            <div class="form-line">
                                <label for="exampleFormControlSelect1">Telefono</label>
                                <br/><input type="number" class="form-control" placeholder="Escriba telefono del cliente" name="telefono" required="required"/>
                            </div>
                            <div class="form-line">
                                <label for="exampleFormControlSelect1">Email</label>
                                <br/><input type="email" class="form-control" placeholder="email@example.com" name="email" required="required" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                        <button type="button" class="btn btn-success  waves-effect"  onclick="guardarCliente(event)">GUARDAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Msearch" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Buscar Cliente</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="list-clientes">
                    <thead>
                       <th>ID</th>
                       <th>NOMBRES</th>
                       <th>TELEFONO</th>
                       <th>EMAIL</th>
                    </thead>
                    <tbody id="clientes">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="MAdicional" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Adicional</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-adicionales">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Nombre</label>
                                    <input type="text" id="a_nombre" placeholder="Nombre del producto" class="form-control" name="nombre">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Precio Compra</label>
                                    <input type="text" id="precio_compra" class="form-control" placeholder="A como te sale" name="precio_compra">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Precio Venta</label>
                                    <input type="text" id="venta" class="form-control" name="precio_venta" placeholder="A como lo piensas vender" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Descripción</label>
                                    <input type="text" id="descripcion" class="form-control" name="descripcion" placeholder="A como lo piensas vender" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                        <button type="button" class="btn btn-success  waves-effect"  onclick="guardarAdicional(event)">GUARDAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('plugins/bootstrap/dataTables.select.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
    <script>
        let table = $('#list-clientes').DataTable();
        document.getElementById('precio_compra').addEventListener('focusout',function(event){
            $('#venta').val(event.target.value);
        });
        function guardarCliente(event){
            event.preventDefault();
            const form = $('#form-cliente').serialize();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'POST',
                url: "{{route('clientes.save')}}",
                data: {
                    '_token' : '{{csrf_token()}}',
                    'form': form
                }
            }).done((msg) => {
                if (msg.status  ==  'ok') {
                    $('#Mcreate').modal('hide');
                    $('#cliente_id').val(msg.cliente.id);
                    $("#c_identificacion").val(msg.cliente.nombres);
                    window.livewire.emit('selectCustomer',msg.cliente.id);
                }else if(msg.status == 'error'){
                    notify('Atención', 'El cliente no pudo ser alamacenada.', 'error');
                }else {
                    let html = '';
                    for(const prop in msg.message){
                        html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                    }
                    notify('Error', html);
                }
            });
        }
        function guardarAdicional(event){
            event.preventDefault();
            const form = $('#form-adicionales').serializeArray();
            if($('#a_nombre').val() == '' || $('#precio_compra').val() == '' || $('#venta').val() == ''){
                notify('Atencion','Debe completar los campos requeridos');
            }
            let producto = {
                'unicode': uuid.v4(),
                'nombre' : $('#a_nombre').val(),
                'costo': $('#precio_compra').val(),
                'precio': $('#venta').val(),
                'precio_show': $('#venta').val(),
                'total': $('#venta').val(),
                'precio_promedio': $('#venta').val(),
                'descripcion': $('#descripcion').val(),
                'cantidad': 1,
            };
            window.livewire.emit('addAdicional',producto);
            $('#MAdicional').modal('hide');
            $('#a_nombre').val('');
            $('#precio_compra').val('');
            $('#venta').val('');
            $('#descripcion').val('');
        }
        function clientes(event){
            event.preventDefault();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'GET',
                url: "{{route('clientes.json')}}",
            }).done((msg) => {
               const clientes = msg;
               if(clientes.length == 0){
                  notify('Atencion','no hay clientes registrados');
               }else{
                   let html = '';
                   table.destroy();
                   clientes.forEach((item)=>{
                         html += `
                                  <tr style='cursor:pointer'>
                                       <td>${item.id}</td>
                                       <td>${item.nombres}</td>
                                       <td>${item.telefono}</td>
                                       <td>${item.email}</td>
                                  </tr>
                                 `;
                   });
                   document.getElementById('clientes').innerHTML = html;
                   $('#Msearch').modal('show');
                   table = $('#list-clientes').DataTable({
                       pageLength: 5,
                       select: true
                   });
                   table.on( 'select', function ( e, dt, type, indexes ) {
                           var rowData = table.rows( indexes ).data().toArray();
                           let row = rowData[0];
                           $('#cliente_id').val(row[0]);
                           $('#c_identificacion').val(row[1]);
                           $('#c_nombres').val(row[2]);
                           $('#Msearch').modal('hide');
                           window.livewire.emit('selectCustomer',row[0]);
                   });
               }
            });
        }

     </script>
    <script>
          window.livewire.on('message',(resp)=> {
              if(resp.status == 'ok'){
                  notify('Atencion',resp.message,'success');
              }else {
                  if(resp.status == 'error'){
                   notify('Error',resp.message,'error');
                  }
              }
          });

          window.livewire.on('changeCount',(resp)=> {
              $('#'+resp.id).val(resp.value);
          });

    </script>
@endsection
