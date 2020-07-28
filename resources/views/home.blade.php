@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="alert bg-blue-grey alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Bienvenid@ <strong></strong> al Sitio Oficial de LANIKORERA. Feliz Día, El Señor te Bendiga en Abundancia!
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-zoom-effect hover-expand-effect">
                    <div class="icon">
                        <a href="{{route('usuario.vistacontrasenia')}}"><i class="material-icons">vpn_key</i></a>
                    </div>
                    <div class="content">
                        <div class="text">CAMBIAR</div>
                        <div class="number">CONTRASEÑA</div>
                    </div>
                </div>
            </div>

            @if(session()->exists('MOD_USUARIOS'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-brown hover-zoom-effect hover-expand-effect">
                        <div class="icon">
                            <a href="{{route('admin.usuarios')}}"><i class="material-icons">person</i></a>
                        </div>
                        <div class="content">
                            <div class="text">ADMINISTRACIÓN DE</div>
                            <div class="number">USUARIOS</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-zoom-effect hover-expand-effect">
                    <div class="icon">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                    <div class="content">
                        <div class="text">SALIR</div>
                        <div class="number">DEL PANEL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
