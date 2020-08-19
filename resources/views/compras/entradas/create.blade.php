@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px;background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.compras')}}">Compras</a></li>
        <li class="active"><a style="color:white" href="{{route('compras.index')}}">Entradas de Almacen</a></li>
        <li class="active"><a style="color:white" href="">Creando una nueva Entrada</a></li>
    </ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    DATOS DE COMPRAS - ENTREDA DE ALMACEN.<small>Ingrese los datos, scanee el codigo de barras y haga click en el boton Guardar.</small>
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
                                        <label for="">Proveedor</label>
                                        <div class="proveedor" style="display: flex; width: 100%">
                                            <input type="hidden" name="proveedor_id" id="proveedor_id">
                                            <input type="text" disabled class="form-control" id="p_nit" placeholder="ingrese la identificacion o nombre del proveedor">
                                            <button class="btn btn-success btn-circle" onclick="event.preventDefault()" data-toggle="modal" data-target="#Mcreate" style="margin-right: 5px;"><i class="fas fa-plus"></i></button>
                                            <button class="btn btn-info btn-circle" onclick="proveedores(event)"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text"  disabled id="v_razon_social" class="form-control" placeholder="JUANITO PROVEEDOR">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">Serie</label>
                                        <input type="text" name="serie" class="form-control" placeholder="serie de la factura de compra">
                                    </div>
                                </div>
                                <div class="col-md-3" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label for="">N° de venta</label>
                                        <input type="text" name="numero_venta" class="form-control" placeholder="numero de venta">
                                    </div>
                                </div>
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
                                        <label for="">Evidencia</label>
                                        <input type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/jpg, documento/pdf" name="foto" class="form-control" placeholder="numero de venta">
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
                <form action="" id="form-proveedor">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">NIT</label>
                                <input type="text" style="border:1px solid black;" name="nit" id="nit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">RAZON SOCIAL</label>
                                <input type="text" style="border:1px solid black;" name="nombre" id="razon_social" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success  waves-effect"  onclick="guardarProveedor(event)">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Msearch" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Buscar Proveedor</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped" id="list-proveedores">
                    <thead>
                       <th>ID</th>
                       <th>NIT</th>
                       <th>RAZON SOCIAL</th>
                    </thead>
                    <tbody id="proveedores">

                    </tbody>
                </table>
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
        let table = $('#list-proveedores').DataTable();
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
                        if(band){
                            productos.push({
                                'id' : producto.unicode,
                                'producto': producto.producto,
                                'codigo_de_barras' : producto.codigo_de_barras,
                                'cantidad' : 0,
                                'costo' : 0
                            })
                            const tr = document.createElement('tr');
                            tr.setAttribute('id',producto.unicode);
                            tr.innerHTML = `
                               <td>${producto.codigo_de_barras}</td>
                               <td>${producto.nombre}x${producto.presentacion}</td>
                               <td>${producto.descripcion}x${producto.unidades} UND</td>
                               <td><input type="number" class="cantidad" onchange="change_cantidad(event,${producto.unicode})" value="0" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 60px;"></td>
                               <td><input type="number" class="costo" onchange="change_costo(event,${producto.unicode})" value="0" style="padding:6px;border: 1px solid grey; border-radius: 20px; width: 100px;"></td>
                               <td class="total">$ 0</td>
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
        function change_cantidad(event,codigo){
            cantidad =  event.target.value < 0 ? 0 : event.target.value ;
            event.target.value = cantidad;
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

        function change_costo(event,codigo){
            costo =  event.target.value < 0 ? 0 : event.target.value ;
            event.target.value = costo;
            let item = document.getElementById(codigo);
            let cantidad = item.querySelector('.cantidad').value;
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
        function guardarProveedor(event){
              event.preventDefault();
              const form = $('#form-proveedor').serialize();
              $.ajax({
                  header: {
                      'X-CSRF-TOKEN': '{{csrf_token()}}'
                  },
                  type:'POST',
                  url: '{{route('proveedores.save')}}',
                  data: {
                      '_token' : '{{csrf_token()}}',
                      'form': form
                  }
              }).done((msg) => {
                  if (msg.status  ==  'ok') {
                      $('#Mcreate').modal('hide');
                      $('#proveedor_id').val(msg.proveedor.id);
                      const nit = $('#nit').val();
                      $('#p_nit').val(nit);
                      const razon_social = $('#razon_social').val();
                      $('#v_razon_social').val(razon_social);
                  }else if(msg.status == 'error'){
                      notify('Atención', 'El producto no pudo ser alamacenada.', 'error');
                  }else {
                      let html = '';
                      for(const prop in msg.message){
                          html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                      }
                      notify('Error', html);
                  }
              });
        }
        function proveedores(event){
            event.preventDefault();
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                type:'GET',
                url: '{{route('proveedores.json')}}',
            }).done((msg) => {
               const proveedores = msg;
               if(proveedores.length == 0){
                  notify('Atencion','no hay proveedores registrados');
               }else{
                   let html = '';
                   table.destroy();
                   proveedores.forEach((item)=>{
                         html += `
                                  <tr>
                                       <td>${item.id}</td>
                                       <td>${item.nit}</td>
                                       <td>${item.nombre}</td>
                                  </tr>
                                 `;
                   });
                   document.getElementById('proveedores').innerHTML = html;
                   $('#Msearch').modal('show');
                   table = $('#list-proveedores').DataTable({
                       pageLength: 5,
                       select: true
                   });
                   table
                       .on( 'select', function ( e, dt, type, indexes ) {
                           var rowData = table.rows( indexes ).data().toArray();
                           let row = rowData[0];
                           $('#proveedor_id').val(row[0]);
                           $('#p_nit').val(row[1]);
                           $('#v_razon_social').val(row[2]);
                           $('#Msearch').modal('hide');
                       });
               }
            });
        }

        function guardar(){
            console.log($('#foto')[0].files[0]);
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
