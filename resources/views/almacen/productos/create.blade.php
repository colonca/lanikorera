@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white" href="{{route('admin.almacen')}}">Almacen</a></li>
        <li class="active"><a style="color:white" href="{{route('productos.index')}}">Productos</a></li>
        <li class="active"><a style="color:white" href="">Creando un nuevo producto</a></li>
    </ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                    PRODUCTOS - MÓDULO ALMACEN DEL SISTEMA
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
                <h1 class="card-inside-title">DATOS DEL PRODUCTO</h1>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <form id="form" class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Nombre *</label>
                                            <br/><input type="text" id="nombre" class="form-control" placeholder="Escriba el nombre del producto" name="nombre" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Presentación *</label>
                                            <br/><input type="text" id="presentacion" class="form-control" placeholder="Ejemplo:750ml,1lt" name="presentacion" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Stock minimo *</label>
                                            <br/><input type="number" min="0" id="stock_minimo" class="form-control" placeholder="notificame para surtir cuando tenga esta cantidad en inventario" name="stock_minimo" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Stock maximo *</label>
                                            <br/><input type="number" min="1" class="form-control" id="stock_maximo" placeholder="notificame para dejar de surtir cuando tenga esta cantidad en inventario" name="stock_maximo" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Marca *</label>
                                            <select class="select2 form-control" name="marca_id" id="marca_id">
                                                <option value=""></option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">Subcategoria *</label>
                                            <select  class="select2 form-control" name="subcategoria_id" id="subcategoria_id">
                                                <option value=""></option>
                                                @foreach($categorias as $categoria)
                                                    <optgroup label="{{$categoria->nombre}}">
                                                       @foreach($categoria->subcategorias as $subcategoria)
                                                            <option value="{{$subcategoria->id}}">{{$subcategoria->nombre}}</option>
                                                       @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="">FOTO</label>
                                            <br/><input type="file" class="form-control" id="foto" name="foto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-12" style="display: flex; justify-content: space-between">
                                <h2>EMBALAJES DEL PRODUCTO</h2>
                                <button onclick="addEmbalaje()" class="btn btn-circle btn-success material-icons">add</button>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label for="">Embalaje</label>
                                    <select name="" id="embalaje_id" class="form-control">
                                        @foreach($embalajes as $embalaje)
                                            <option value="{{$embalaje->id}}">{{$embalaje->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Codigo de barras</label>
                                        <br/><input type="text" id="codigo_de_barras" class="form-control" placeholder="ingrese manual o con el lector" name="codigo_de_barras"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Unidades</label>
                                        <br/><input type="number" min="1" id="unidades" class="form-control" placeholder="unidades del embalaje" name="unidades"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="">Precio de venta</label>
                                        <br/><input type="number" id="precio_venta" min="0" class="form-control" placeholder="ingrese el precio de venta del producto acorde al embalaje" name="precio_venta"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <th>EMBALAJE</th>
                                    <th>CODIGO DE BARRAS</th>
                                    <th>UNIDADES</th>
                                    <th>PRECIO DE VENTA</th>
                                    </thead>
                                    <tbody id="embalajes">
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <br/><br/><a href="{{route('productos.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                <button class="btn bg-indigo waves-effect" onclick="limpiar(event)">Limpiar Formulario</button>
                                <button class="btn bg-green waves-effect" type="submit" onclick="guardar(event)">Guardar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-brown">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">SOBRE LOS MÓDULOS</h4>
            </div>
            <div class="modal-body">
                <strong>Agregue nuevos productos,</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ACEPTAR</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.select2').select2();
        let embalajes = [];

        codigo = document.getElementById('codigo_de_barras');
        codigo.addEventListener('keypress',(event)=>{
            if(event.keyCode == 13){
                $('#unidades').focus();
            }
        });

        function addEmbalaje() {
            let codigo_de_barras,unidades,precio_venta,embalaje_id;
            codigo_de_barras = $('#codigo_de_barras').val();
            unidades = $('#unidades').val();
            precio_venta = $('#precio_venta').val();
            embalaje_id = $('#embalaje_id').val();
            let select = document.getElementById('embalaje_id');
            let embalaje = select.options[select.selectedIndex].text;
            const validacion = validarDatos(codigo_de_barras,unidades,precio_venta,embalaje_id);
            if(validacion){
                let exist =  false;
                embalajes.forEach(value =>{
                   if(value.embalaje_id == embalaje_id){
                       value.embalaje_id = embalaje_id;
                       value.embalaje = embalaje;
                       value.codigo_de_barras = codigo_de_barras;
                       value.unidades = unidades;
                       value.precio_venta = precio_venta;
                       exist = true;
                       document.getElementById(`${embalaje_id}`).innerHTML = `<td>${embalaje}</td>
                                                                                <td>${codigo_de_barras}</td>
                                                                                <td>${unidades}</td>
                                                                                <td>${number_format(precio_venta,0)}</td>
                                                                                <td style="text-align: center;">
                                                                                    <a href=""
                                                                                       class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                                                                       data-placement="top" title="Eliminar"><i
                                                                                            class="material-icons" onclick="eliminar(event,${embalaje_id})">delete</i></a>
                                                                                 </td>
                                                                                 `;
                   }
                });
                if(!exist){
                    let table = document.getElementById('embalajes');
                    let tr = document.createElement('tr');
                    tr.setAttribute('id',embalaje_id);
                    tr.innerHTML = `<td>${embalaje}</td>
                                    <td>${codigo_de_barras}</td>
                                    <td>${unidades}</td>
                                    <td>${number_format(precio_venta,0)}</td>
                                    <td style="text-align: center;">
                                        <a href=""
                                           class="btn bg-indigo waves-effect btn-xs" data-toggle="tooltip"
                                           data-placement="top" title="Eliminar"><i
                                                class="material-icons" onclick="eliminar(event,${embalaje_id})">delete</i></a>
                                     </td>
                                     `;
                    table.appendChild(tr);
                    embalajes.push({
                        embalaje_id,
                        embalaje,
                        codigo_de_barras,
                        unidades,
                        precio_venta
                    });
                }
                $('#codigo_de_barras').val('');
                $('#unidades').val('');
                $('#precio_venta').val('');
            }else{
                notify('Error', 'Debe llenar todos los datos para agregar el embalaje', 'error');
            }
        }

        function validarDatos(codigo_de_barras,unidades,precio_venta,embalaje_id){
            let band =  true;
           if(codigo_de_barras === '' || unidades == '' || precio_venta == '' || embalaje_id == ''){
               band = false
           }
           if(isNaN(unidades) || isNaN(precio_venta)){
               band = false;
           }
           return band;
        }

        function  eliminar(event,id) {
            event.preventDefault();
            embalajes.forEach((value,index) =>{
                if(value.embalaje_id == id){
                    embalajes.splice(index,1);
                }
            });
            document.getElementById(id).remove();
        }

        function guardar(event) {
            event.preventDefault();
            var formData = new FormData();
            var x = $("form").serializeArray();
            $.each(x, function(i, field){
                formData.append(field.name, field.value);
            });
             var file = $('#foto')[0].files[0];
             formData.append('file',file);
             formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
             formData.append('embalajes', JSON.stringify(embalajes));
             let valido = validarForm();
             if(valido){
                 $.ajax({
                     type: 'POST',
                     url: '{{route('productos.store')}}',
                     data: formData,
                     contentType: false,
                     processData: false,
                 }).done(function (msg) {
                     if (msg.status  ==  'ok') {
                         notify('Atención', 'El producto.' + $("#nombre").val() +' fue creada con exito.!', 'success');
                         limpiar()
                     }else if(msg.status == 'error'){
                         notify('Atención', 'El producto.' + $("#nombre").val() + ' no pudo ser alamacenada.', 'error');
                     }else {
                         let html = '';
                         for(const prop in msg.message){
                             html += `</br> <strong>${prop}</strong> : ${msg.message[prop]}`;
                         }
                         notify('Error', html);
                     }
                 });
             }else{
                 notify('Error', 'Debe llenar todos los campos requeridos para guardar el producto', 'error');
             }
        }

        function limpiar(){
            $('#nombre').val('');
            $('#presentacion').val('');
            $('#stock_minimo').val('');
            $('#stock_maximo').val('');
            $('#codigo_de_barras').val('');
            $('#unidades').val('');
            $('#precio_venta').val('');
            $('#foto').val('');
            embalajes = [];
            document.getElementById('embalajes').innerHTML = '';
        }

        function  validarForm() {
            let band =  true;
            let nombre,presentacion,stock_minimo,stock_maximo;
            nombre = $('#nombre').val();
            presentacion = $('#presentacion').val();
            stock_minimo = $('#stock_minimo').val();
            stock_maximo = $('#stock_maximo').val();
            if(nombre == '' || presentacion == '' || stock_minimo == '' || stock_maximo == ''){
                 band = false;
            }
            return band;
        }

    </script>
@endsection
