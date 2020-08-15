@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-bg-blue-grey" style="margin-bottom: 30px;">
        <li><a href="{{route('inicio')}}">Inicio</a></li>
        <li><a href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a href="">Nueva Factura</a></li>
    </ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    Factura de Venta
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a data-toggle="modal" data-target="#mdModal">Ayuda</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="row clearfix">
                    <div class="col-md-12" style="margin-bottom: 0;">
                        <form id="form" action="{{route('compras.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" id="datePicker" name="fecha" class="form-control" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Cliente</label>
                                        <div class="proveedor" style="display: flex; width: 100%">
                                            <input type="hidden" name="cliente_id" id="cliente_id">
                                            <input type="text" disabled class="form-control" id="c_identificacion" placeholder="ingrese la identificacion o nombre del cliente">
                                            <button class="btn btn-success btn-circle" onclick="event.preventDefault()" data-toggle="modal" data-target="#Mcreate" style="margin-right: 5px;"><i class="fas fa-plus"></i></button>
                                            <button class="btn btn-info btn-circle" onclick="clientes(event)"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text"  disabled id="c_nombres" class="form-control" placeholder="JUANITO PROVEEDOR">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Bodegas</label>
                                        <select name="bodega_id" class="select2 form-control" name="bodega_id" id="">
                                             @foreach($bodegas as $bodega)
                                                <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Modalidad de Pago</label>
                                        <select name="modalidad" class="select2 form-control" id="">
                                            <option value="contado" selected>CONTADO</option>
                                            <option value="credito">CREDITO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Medio de pago</label>
                                        <select name="modalidad" class="select2 form-control" id="">
                                            <option value="efectivo" selected>Efectivo</option>
                                            <option value="datafono">Datafono</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Factura de Venta</label>
                                        <input type="text" disabled class="form-control" value="NIK-0002">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="row" style="width: 90%; margin: 0 auto;">
                             <div class="col-md-6" style="display: flex">
                                 <input type="text" class="form-control" id="cogigo" onkeypress="buscarProducto(event)" placeholder="scanee o ingrese el codigo del producto">
                                 <button class="btn btn-info">Enter para agregar</button>
                             </div>
                            <div class="col-md-6" style="display: flex; justify-content: flex-end;">
                                <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#MAdicional"><i class="fab fa-amilia"></i></button>
                            </div>
                        </div>
                        <div class="row" style="width: 90%; margin: 0 auto;">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead class="bg-info">
                                         <th>Codigo</th>
                                         <th>Producto</th>
                                         <th>Embalaje</th>
                                         <th>Cantidad</th>
                                         <th>Precio</th>
                                         <th>Total</th>
                                    </thead>
                                    <tbody id="productos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="width: 90%; margin: 0 auto;">
                            <div class="col-md-12" style="display: flex; justify-content: flex-end;">
                                <a href="{{route('admin.compras')}}" class="btn btn-danger" style="margin-right: 5px;">Cancelar</a>
                                <button class="btn btn-success" onclick="guardar()">Guardar Compra</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Mcreate" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Nuevo Proveedor</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-cliente">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-line" >
                                <label for="exampleFormControlSelect1">Identidicación</label>
                                <br/><input type="number" id="identificacion" class="form-control" placeholder="Escriba la cedula del cliente" name="identificacion" required="required" />
                            </div>
                            <div class="form-line">
                                <label for="exampleFormControlSelect1">Nombres</label>
                                <br/><input type="text" id="nombres" class="form-control" placeholder="Escriba nombre del cliente" name="nombres"required="required"/>
                            </div>
                            <div class="form-line">
                                <label for="exampleFormControlSelect1">Apellidos</label>
                                <br/><input type="text" class="form-control" placeholder="Escriba apellidos del cliente" name="apellidos" required="required"/>
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
                <h4 class="modal-title" id="defaultModalLabel">Buscar Proveedor</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="list-clientes">
                    <thead>
                       <th>ID</th>
                       <th>IDENTIFICACÓN</th>
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
                <h4 class="modal-title" id="defaultModalLabel">Buscar Proveedor</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-adicionales">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="">Nombre</label>
                                    <input type="text" placeholder="Nombre del producto" class="form-control" name="nombre">
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
                                    <input type="text" id="venta" class="form-control" name="descripcion" placeholder="A como lo piensas vender" >
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
    <script>
        $('.select2').select2();
        var productos = [];
        let table = $('#list-clientes').DataTable();
        document.getElementById('precio_compra').addEventListener('focusout',function(event){
            $('#venta').val(event.target.value);
        });
        function buscarProducto(event){
            if(event.keyCode == 13){
                const  codigo = $('#cogigo').val();
                $.ajax({
                    type: 'GET',
                    url: '{{url('almacen/producto/search')}}/'+codigo,
                }).done(function (msg) {

                    if(msg.status == 'ok'){
                        const producto = msg.producto;
                        let band = true;
                        productos.forEach((item)=>{
                            if(item.id == producto.unicode){
                                band = false;
                            }
                        });
                        const existencia = producto.existencia_embalaje > 0;
                        if(!existencia){
                            notify('Atencion','no hay stock en inventario');
                        }

                        if(band && existencia){
                            productos.push({
                                'id' : producto.unicode,
                                'producto': producto.producto,
                                'codigo_de_barras' : producto.codigo_de_barras,
                                'cantidad' : 0,
                                'precio' : producto.precio
                            })
                            const tr = document.createElement('tr');
                            tr.setAttribute('id',producto.unicode);
                            tr.innerHTML = `
                               <td>${producto.codigo_de_barras}</td>
                               <td>${producto.nombre}x${producto.presentacion}</td>
                               <td>${producto.descripcion}x${producto.unidades} UND</td>
                               <td><input type="number"  class="cantidad" onchange="change_cantidad(event,${producto.unicode},${producto.existencia_embalaje},${producto.existencia})" value="1" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 60px;"></td>
                               <td><input type="number" disabled class="costo"  value="${producto.precio}" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 100px;"></td>
                               <td class="total">$ ${producto.precio}</td>
                               <td><button class="btn btn-danger" onclick="eliminar_item(event,${producto.unicode})" > <i class="fas fa-times"></i></button></td>
                        `;
                            document.getElementById('productos').appendChild(tr);
                        }
                        $('#cogigo').val('');
                    }else{
                        notify('Atención', 'El producto con el codigo ' + $('#cogigo').val() +' no ha sido registrado.!', 'warning');
                        $('#cogigo').val('');
                    }
                });
            }
        }
        function change_cantidad(event,codigo,existencia_embalaje,existencia){
            cantidad =  event.target.value <= 0 ? 1 : event.target.value ;
            event.target.value = cantidad;
            if(cantidad > existencia_embalaje) {
                notify('Atención', `La cantidad selecionada no se encuentra disponible, en stock solo quedan ${existencia_embalaje} UND del embalaje selecionado y Unidades Individuales del producto quedan ${existencia}`, 'warning');
                cantidad = existencia_embalaje;
                event.target.value = cantidad;
            }
            let item = document.getElementById(`${codigo}`);
            let costo = item.querySelector('.costo').value;
            let total = cantidad*costo;
            item.querySelector('.total').innerHTML = '$ '+total;
            productos.forEach((item)=> {
                if(item.id == codigo){
                    item.cantidad = cantidad,
                    item.costo = costo
                }
            });
        }
        function eliminar_item(event,codigo) {
           document.getElementById(`${codigo}`).remove();
           productos.forEach((item,index) => {
               if(item.id == codigo){
                   productos.splice(index,1);
               }
           });
            $('#cogigo').focus();
        }
        function guardarCliente(event){
            event.preventDefault();
            const form = $('#form-cliente').serialize();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'POST',
                url: '{{route('clientes.save')}}',
                data: {
                    '_token' : '{{csrf_token()}}',
                    'form': form
                }
            }).done((msg) => {
                if (msg.status  ==  'ok') {
                    $('#Mcreate').modal('hide');
                    $('#cliente_id').val(msg.cliente.id);
                    $("#c_identificacion").val(msg.cliente.identificacion);
                    $("#c_nombres").val(msg.cliente.nombres);
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
            const form = $('#form-adicionales').serialize();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'POST',
                url: '{{route('adicional.save')}}',
                data: {
                    '_token' : '{{csrf_token()}}',
                    'form': form
                }
            }).done((msg) => {
                if (msg.status  ==  'ok') {
                   alert('guardo');
                }else if(msg.status == 'error'){
                    notify('Atención', 'El adicional no pudo ser alamacenado.', 'error');
                }else {
                    let html = '';
                    for(const prop in msg.message){
                        html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                    }
                    notify('Error', html);
                }
            });
        }
        function clientes(event){
            event.preventDefault();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'GET',
                url: '{{route('clientes.json')}}',
            }).done((msg) => {
               const clientes = msg;
               if(clientes.length == 0){
                  notify('Atencion','no hay clientes registrados');
               }else{
                   let html = '';
                   table.destroy();
                   clientes.forEach((item)=>{
                         html += `
                                  <tr>
                                       <td>${item.id}</td>
                                       <td>${item.identificacion}</td>
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
                   });
               }
            });
        }
        function guardar(){
            var formData = new FormData();
            var x = $("form").serializeArray();
            $.each(x, function(i, field){
                formData.append(field.name, field.value);
            });
            var file = $('#foto')[0].files[0];
            formData.append('file',file);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('embalajes', JSON.stringify(productos));
            $.ajax({
                type: 'POST',
                url: '{{route('compras.store')}}',
                data: formData,
                contentType: false,
                processData: false,
            }).done(function (msg) {
                if (msg.status  ==  'ok') {
                    notify('Atención', 'La compra fue almacenada con exito.!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                }else if(msg.status == 'error'){
                    notify('Atención', 'la compra no pudo ser alamacenada.', 'error');
                }else {
                    let html = '';
                    for(const prop in msg.message){
                        html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                    }
                    notify('Error', html);
                }
            });
        }



     </script>
@endsection
