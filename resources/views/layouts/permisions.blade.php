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
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="row clearfix">
                    <div class="col-md-12" style="margin-bottom: 0;">
                        <form class="code" id="verification_code_form">
                                <div class="container_code" >
                                    <P>ENTER VERIFICATION CODE</P>
                                    <input type="text" name="code" placeholder="verificated code">
                                    <button type="submit" class="btn btn-success" style="margin-top: 2em">Verificar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>