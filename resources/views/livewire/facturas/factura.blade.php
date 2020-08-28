<div>
    <div class="row clearfix" style="position: relative;">
        <div wire:loading>
            <div id="loader"></div>
            <div id="myDiv"></div>
        </div>
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
                            <form id="form" wire:submit.prevent="guardar" method="POST" >
                                @csrf
                                <div class="row" style="width: 90%; margin: 0 auto;">
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Fecha</label>
                                            <input type="date" disabled id="datePicker" name="fecha" class="form-control" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Cliente</label>
                                            <div class="proveedor" style="display: flex; width: 100%">
                                                <input type="hidden" wire:model="cliente_id">
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
                                            <select wire:model="bodega" class="form-control">
                                                @foreach($bodegas as $bodega)
                                                    <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Modalidad de Pago</label>
                                            <select wire:model="modalidad_pago" class="form-control" id="">
                                                <option value="contado" selected>CONTADO</option>
                                                <option value="credito">CREDITO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Medio de pago</label>
                                            <select wire:model="medio_pago" wire:click="change()" class="form-control" >
                                                <option value="efectivo" selected>EFECTIVO</option>
                                                <option value="datafono">DATAFONO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Factura de Venta</label>
                                            <input type="text" disabled class="form-control" wire:model="venta">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-6">
                                    <form wire:submit.prevent="searchProduct"  style="display: flex">
                                        <input type="text" wire:model.lazy="search"  class="form-control" placeholder="scanee o ingrese el codigo del producto">
                                        <button type="submit" class="btn btn-info">Enter para agregar</button>
                                    </form>
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
                                        @foreach($productos as $producto)
                                            <tr>
                                                <td>{{$producto['codigo_de_barras']}}</td>
                                                <td>{{$producto['nombre'].'x'.$producto['presentacion']}}</td>
                                                <td>{{$producto['embalaje']}}</td>
                                                <td><input type="number" id="{{$producto['unicode']}}" wire:click="addCantidad('{{$producto['unicode']}}',$event.target.value)" wire:keydown.debounce.500ms="addCantidad('{{$producto['unicode']}}',$event.target.value)" style="border-radius: 20px; border:1px solid grey; width: 60px; padding: 5px;" value="{{$producto['cantidad']}}"></td>
                                                <td>{{$producto['precio_show']}}</td>
                                                <td>{{$producto['total']}}</td>
                                                <td style="text-align: center;">
                                                    <a href="" wire:click.prevent="delete('{{$producto['unicode']}}')"
                                                       class="btn btn-danger waves-effect btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="Eliminar" style="padding: 5px;"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($adicionales as $adicional)
                                            <tr>
                                                <td>{{$adicional['unicode']}}</td>
                                                <td>{{$adicional['nombre']}}</td>
                                                <td>UNIDAD</td>
                                                <td><input type="number" id="{{$adicional['unicode']}}" wire:click="addCantidadAdicional('{{$adicional['unicode']}}',$event.target.value)"  wire:kerdown="addCantidadAdicional('{{$adicional['unicode']}}',$event.target.value)"  style="border-radius: 20px; border:1px solid grey; width: 60px; padding: 5px;" value="{{$adicional['cantidad']}}"></td>
                                                <td>{{number_format($adicional['precio'])}}</td>
                                                <td>{{$adicional['total']}}</td>
                                                <td style="text-align: center;">
                                                    <a href="" wire:click.prevent="deleteAdicional('{{$adicional['unicode']}}')"
                                                       class="btn btn-danger waves-effect btn-xs" data-toggle="tooltip"
                                                       data-placement="top" title="Eliminar" style="padding: 5px;"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-12" style="display: flex; justify-content: flex-end; margin-bottom: 0;">
                                    <p><strong>Total:</strong> </p>
                                    <p id="f_total">$ {{number_format($total)}}</p>
                                </div>
                            </div>
                            <div class="row" style="width: 90%; margin: 0 auto;">
                                <div class="col-md-12" style="display: flex; justify-content: flex-end;">
                                    <a href="{{route('admin.compras')}}" class="btn btn-danger" style="margin-right: 5px;">Cancelar</a>
                                    <button class="btn btn-success" wire:click="guardar">Facturar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

