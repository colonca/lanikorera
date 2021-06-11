<div class="position row clearfix" id="descuento_create">
    <div wire:loading.delay>
        <div id="loader"></div>
        <div id="myDiv"></div>
    </div>
    @if($page === 'descuento-update')
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATOS DE VENTAS - DESCUENTOS EN EL SISTEMA. <small>Ingrese los datos y haga click en el boton Guardar.</small>
                    </h2>
                </div>
                <div class="body">
                    @include('flash::message')
                    <div class="col-md-12">
                        @component('layouts.errors')
                        @endcomponent
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12" id="form_div" style="margin-bottom: 0;">
                            <form wire:submit.prevent="save">
                                <div class="row" style="width: 90%; margin: 0 auto;">
                                    <div class="col-md-6" style="margin-bottom: 0">
                                        <div class="form-group">
                                                <label for="">Fecha Inicio</label>
                                                <input type="date" id="datePicker" wire:model.lazy="fecha_inicio" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label for="">Fecha Final</label>
                                            <input type="date" id="datePicker" wire:model.lazy="fecha_fin"  class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="width: 90%; margin: 0 auto;">
                                    <div class="col-md-3" style="display: flex">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="">Codigo de Barras</label>
                                                <input type="text" class="form-control" wire:model="codigo_barras" wire:keydown.enter="searchProduct($event.target.value)" placeholder="scanee o ingrese el codigo del producto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="display: flex">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="">Producto</label>
                                                <input type="text" class="form-control" wire:model.lazy="product" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="">Cantidad Destinda</label>
                                                <br/>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    wire:model.lazy="count"
                                                    placeholder="Cantidad de la promoción"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="">Precio</label>
                                                <br/><input type="number"
                                                    class="form-control"
                                                    min="1"
                                                    wire:model.lazy="precio"
                                                    placeholder="valor promo"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br/><br/><a href="{{route('descuentos.index')}}" class="btn bg-red waves-effect">Cancelar</a>
                                    <button class="btn bg-indigo waves-effect" type="reset">Limpiar Formulario</button>
                                    <!-- Button trigger modal -->
                                    <button type="submit" class="btn btn-success waves-effect">
                                        Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row clearfix" id="verification_code">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TRANSACCIÓN PROTEGIDA - FAVOR COMUNICARSE CON EL ADMINISTRADOR PARA QUE OTORGUE LOS PERMISOS
                            <small>EL ADMINISTRADOR SUMINISTRARÁ UN CODIGO DE VERIFICACIÓN PARA CONTINUAR </small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="col-md-12">
                            @include('flash::message')
                            @component('layouts.errors')
                            @endcomponent
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12" style="margin-bottom: 0;">
                                <form class="code" wire:submit.prevent="verification" >
                                        <div class="container_code" >
                                            <P>ENTER VERIFICATION CODE</P>
                                            <input type="number" wire:model.lazy="code" placeholder="verificated code" maxlength="5">
                                            <button type="submit" class="btn btn-success" style="margin-top: 2em">Verificar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
