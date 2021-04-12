@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/permission.css')}}" rel="stylesheet">
@endsection
@section('breadcrumb')
<ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
    <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
    <li class="active"><a style="color:white" >Permisos</a></li>
</ol>
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h2>
                  TRANSACCIÓN PROTEGIDA - FAVOR COMUNICARSE CON EL ADMINISTRADOR PARA QUE OTORGUE LOS PERMISOS
                    <small>EL ADMINISTRADOR SUMINISTRARÁ UN CODIGO DE VERIFICACIÓN PARA CONTINUAR </small>
                </h2>
            </div>
            <div class="body">
                <div class="container_code" >
                   <P>ENTER VERIFICATION CODE</P>
                    <input type="text" name="code" placeholder="verificated code">
                    <button class="btn btn-success" style="margin-top: 2em"  >Verificar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

