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
            display: none;
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

        #myDiv {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: black;
            opacity: 0.8;
            z-index: 1000;
        }
    </style>
@endsection
@section('content')
<div id="loader"></div>
<div id="myDiv"></div>
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE VENTAS - FACTURA DE VENTA. <small>Ingrese los datos, scanee el codigo de barras y haga click en el boton Guardar.</small>
                </h2>
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
                                            <select name="modalidad_pago" class="select2 form-control" id="">
                                                <option value="contado" selected>CONTADO</option>
                                                <option value="credito">CREDITO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Medio de pago</label>
                                            <select name="medio_pago" onchange="cambio(event)" class="select2 form-control" id="modalidad">
                                                <option value="efectivo" selected>EFECTIVO</option>
                                                <option value="datafono">DATAFONO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Factura de Venta</label>
                                            <input type="text" disabled class="form-control" value="{{$serie->prefijo.'-'.$serie->actual}}">
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
                                    <thead class="bg-info" >
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
                            <div class="col-md-12" style="display: flex; justify-content: flex-end; margin-bottom: 0;">
                               <p><strong>Total:</strong> </p>
                               <p id="f_total">$ 0</p>
                            </div>
                            <div class="col-md-12" style="display: flex; justify-content: flex-end; margin-bottom: 0;">
                                <p><strong>Impuesto:</strong> </p>
                                <p id="f_impuesto">$ 0</p>
                            </div>
                        </div>
                        <div class="row" style="width: 90%; margin: 0 auto;">
                            <div class="col-md-12" style="display: flex; justify-content: flex-end;">
                                <a href="{{route('admin.compras')}}" class="btn btn-danger" style="margin-right: 5px;">Cancelar</a>
                                <button class="btn btn-success" onclick="guardar()">Facturar</button>
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
                            <div class="form-line">
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
        $('.select2').select2();
        var productos = [];
        let table = $('#list-clientes').DataTable();
        document.getElementById('precio_compra').addEventListener('focusout',function(event){
            $('#venta').val(event.target.value);
        });

        function cambio(event){
            let total = 0;
            productos.forEach((item)=>{
                if(item.tipo == 'STOCK'){
                    total += item.cantidad*item.precio;
                }else{
                    total += item.cantidad*item.precio_venta;
                }
            });
            if($('#modalidad').val() == 'datafono'){
                document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                document.getElementById('f_total').innerHTML = '$ '+total*1.05;
            }else{
                document.getElementById('f_total').innerHTML = '$ '+total;
                document.getElementById('f_impuesto').innerHTML = '$ 0';
            }
        }
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

                        let total = 0;
                        productos.forEach((item)=> {
                            if(producto.producto == item.producto){
                                total += item.unidades * item.cantidad;
                            }
                        });
                        total += producto.unidades*1;
                        if(total > producto.existencia || !existencia){
                            notify('Atencion','no hay stock en inventario');
                            band = false;
                        }

                        if(band && existencia){
                            productos.push({
                                'id' : producto.unicode,
                                'producto': producto.producto,
                                'codigo_de_barras' : producto.codigo_de_barras,
                                'cantidad' : 1,
                                'precio' : producto.precio,
                                'unidades' : producto.unidades,
                                'tipo': 'STOCK'
                            })
                            const tr = document.createElement('tr');
                            tr.setAttribute('id',producto.unicode);
                            tr.innerHTML = `
                               <td>${producto.codigo_de_barras}</td>
                               <td>${producto.nombre}x${producto.presentacion}</td>
                               <td>${producto.descripcion}x${producto.unidades} UND</td>
                               <td><input type="number"  class="cantidad" onchange="change_cantidad(event,${producto.unicode},${producto.existencia_embalaje},${producto.existencia},${producto.producto},${producto.unidades})" value="1" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 60px;"></td>
                               <td><input type="number" disabled class="costo"  value="${producto.precio}" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 100px;"></td>
                               <td class="total" style="width: 100px;">$ ${producto.precio}</td>
                               <td><button class="btn btn-danger" onclick="eliminar_item(event,${producto.unicode})" > <i class="fas fa-times"></i></button></td>
                        `;
                            document.getElementById('productos').appendChild(tr);
                        }
                        total = 0;
                        productos.forEach((item)=>{
                            if(item.tipo == 'STOCK'){
                                total += item.cantidad*item.precio;
                            }else{
                                total += item.cantidad*item.precio_venta;
                            }
                        });

                        if($('#modalidad').val() == 'datafono'){
                            document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                            document.getElementById('f_total').innerHTML = '$ '+total*1.05;
                        }else{
                            document.getElementById('f_total').innerHTML = '$ '+total;
                            document.getElementById('f_impuesto').innerHTML = '$ 0';
                        }

                        $('#cogigo').val('');
                    }else{
                        notify('Atención', 'El producto con el codigo ' + $('#cogigo').val() +' no ha sido registrado.!', 'warning');
                        $('#cogigo').val('');
                    }
                });
            }
        }
        function change_cantidad(event,codigo,existencia_embalaje,existencia,producto,unidades){
            aux =  event.target.value <= 0 ? 1 : event.target.value ;
            let total = 0;
            productos.forEach((item)=> {
                if(producto == item.producto){
                    total += item.unidades * item.cantidad;
                }
            });
            total += unidades*aux;
            cantidad = aux;
            event.target.value = cantidad;
            if(cantidad > existencia_embalaje) {
                notify('Atención', `La cantidad selecionada no se encuentra disponible, en stock solo quedan ${existencia_embalaje} UND del embalaje selecionado y Unidades Individuales del producto quedan ${existencia}`, 'warning');
                cantidad = existencia_embalaje;
                event.target.value = cantidad;
            }
            let item = document.getElementById(`${codigo}`);
            let costo = item.querySelector('.costo').value;
            total = cantidad*costo;
            item.querySelector('.total').innerHTML = '$ '+total;
            productos.forEach((item)=> {
                if(item.id == codigo){
                    item.cantidad = cantidad,
                    item.costo = costo
                }
            });
            total = 0;
            productos.forEach((item)=>{
                if(item.tipo == 'STOCK'){
                    total += item.cantidad*item.precio;
                }else{
                    total += item.cantidad*item.precio_venta;
                }
            });
            if($('#modalidad').val() == 'datafono'){
                document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                document.getElementById('f_total').innerHTML = '$ '+total*1.05;
            }else{
                document.getElementById('f_total').innerHTML = '$ '+total;
                document.getElementById('f_impuesto').innerHTML = '$ 0';
            }

        }
        function change_cant(event,codigo){
            cantidad =  event.target.value <= 0 ? 1 : event.target.value ;
            event.target.value = cantidad;
            let item = document.getElementById(`${codigo}`);
            let precio = item.querySelector('.precio').value;
            let total = cantidad*precio;
            item.querySelector('.total').innerHTML = '$ '+total;
            productos.forEach((item)=> {
                if(item.id == codigo){
                    item.cantidad = cantidad
                }
            });
            total = 0;
            productos.forEach((item)=>{
                if(item.tipo == 'STOCK'){
                    total += item.cantidad*item.precio;
                }else{
                    total += item.cantidad*item.precio_venta;
                }
            });
            if($('#modalidad').val() == 'datafono'){
                document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                document.getElementById('f_total').innerHTML = '$ '+total*1.05;
            }else{
                document.getElementById('f_total').innerHTML = '$ '+total;
                document.getElementById('f_impuesto').innerHTML = '$ 0';
            }
        }
        function eliminar_item(event,codigo) {
           document.getElementById(`${codigo}`).remove();
           productos.forEach((item,index) => {
               if(item.id == codigo){
                   productos.splice(index,1);
               }
           });
            $('#cogigo').focus();
            let total = 0;
            productos.forEach((item)=>{
                if(item.tipo == 'STOCK'){
                    total += item.cantidad*item.precio;
                }else{
                    total += item.cantidad*item.precio_venta;
                }
            });
            if($('#modalidad').val() == 'datafono'){
                document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                document.getElementById('f_total').innerHTML = '$ '+total*1.05;
            }else{
                document.getElementById('f_total').innerHTML = '$ '+total;
                document.getElementById('f_impuesto').innerHTML = '$ 0';
            }
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
            const form = $('#form-adicionales').serializeArray();
            if($('#a_nombre').val() == '' || $('#precio_compra').val() == '' || $('#venta').val() == ''){
                notify('Atencion','Debe completar los campos requeridos');
            }
            let producto = {
                'id': uuid.v4(),
                'nombre' : $('#a_nombre').val(),
                'precio_compra': $('#precio_compra').val(),
                'precio_venta': $('#venta').val(),
                'descripcion': $('#descripcion').val(),
                'cantidad': 1,
                'tipo': 'ADICIONAL'
            };
            productos.push(producto);
            const tr = document.createElement('tr');
            tr.setAttribute('id',producto.id);
            tr.innerHTML = `
                               <td>${producto.id}</td>
                               <td>${producto.nombre}</td>
                               <td>${''} UND</td>
                               <td><input type="number"  class="cantidad" onchange="change_cant(event,'${producto.id}')"  value="1" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 60px;"></td>
                               <td><input type="number" disabled class="precio"   value="${producto.precio_venta}" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 100px;"></td>
                               <td class="total" style="width:100px;">$ ${producto.precio_venta}</td>
                               <td><button class="btn btn-danger" onclick="eliminar_item(event,'${producto.id}')" > <i class="fas fa-times"></i></button></td>
                        `;
            document.getElementById('productos').appendChild(tr);
            $('#MAdicional').modal('hide');
            $('#a_nombre').val('');
            $('#precio_compra').val('');
            $('#venta').val('');
            $('#descripcion').val('');
            let total = 0;
            productos.forEach((item)=>{
                if(item.tipo == 'STOCK'){
                    total += item.cantidad*item.precio;
                }else{
                    total += item.cantidad*item.precio_venta;
                }
            });
            if($('#modalidad').val() == 'datafono'){
                document.getElementById('f_impuesto').innerHTML = '$ '+total*0.05;
                document.getElementById('f_total').innerHTML = '$ '+total*1.05;
            }else{
                document.getElementById('f_total').innerHTML = '$ '+total;
                document.getElementById('f_impuesto').innerHTML = '$ 0';
            }
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
            if(productos.length <= 0){
                notify('Atencion','Debe agregar al menos un producto para facturar.');
                return;
            }
            var formData = new FormData();
            var x = $("form").serializeArray();
            $.each(x, function(i, field){
                formData.append(field.name, field.value);
            });
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('productos', JSON.stringify(productos));
            document.getElementById("loader").style.display = "block";
            document.getElementById("myDiv").style.display = "block";
            window.scroll(0,0);
            $.ajax({
                type: 'POST',
                url: '{{route('mfacturas.store')}}',
                data: formData,
                contentType: false,
                processData: false,
            }).done(function (msg) {
                document.getElementById("loader").style.display = "none";
                document.getElementById("myDiv").style.display = "none";
                if (msg.status  ==  'ok') {
                    notify('Atención', 'La factura fue almacenada con exito.!', 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                }else if(msg.status == 'error'){
                    notify('Atención', 'la factuta no pudo ser alamacenada.', 'error');
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
