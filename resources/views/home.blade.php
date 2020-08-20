@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="alert alert-dismissible" style="background-color: #FFD700;" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span style="color:black" aria-hidden="true">×</span></button>
             <strong style="color:black">Bienvenid@  al Sitio Oficial de LANIKORERA. Feliz Día, El Señor te Bendiga en Abundancia!</strong>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box  hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                    <div class="icon">
                        <a href="{{route('usuario.vistacontrasenia')}}"><i class="material-icons">vpn_key</i></a>
                    </div>
                    <div class="content">
                        <div style="color:white" class="text">CAMBIAR</div>
                        <div style="color:white" class="number">CONTRASEÑA</div>
                    </div>
                </div>
            </div>

            @if(session()->exists('MOD_USUARIOS'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.usuarios')}}"><i class="material-icons">person</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">ADMINISTRACIÓN DE</div>
                            <div style="color:white" class="number">USUARIOS</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->exists('MOD_ALMACEN'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.almacen')}}"><i class="material-icons">storefront</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">ADMINISTRACIÓN DE</div>
                            <div style="color:white" class="number">ALMACEN</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->exists('MOD_COMPRAS'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.compras')}}"><i class="material-icons">style</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">ADMINISTRACIÓN DE</div>
                            <div style="color:white" class="number">COMPRAS</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->exists('MOD_VENTAS'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.ventas')}}"><i class="material-icons">import_contacts</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">ADMINISTRACIÓN DE</div>
                            <div style="color:white" class="number">VENTAS</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->exists('MOD_REPORTES'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.configuracion')}}"><i class="material-icons">stacked_line_chart</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">VISUALIZACIÓN DE</div>
                            <div style="color:white" class="number">REPORTES</div>
                        </div>
                    </div>
                </div>
            @endif
            @if(session()->exists('MOD_CONFIGURACION'))
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect hover-expand-effect" style="background-color: #38383A; color:white">
                        <div class="icon">
                            <a href="{{route('admin.configuracion')}}"><i class="material-icons">settings</i></a>
                        </div>
                        <div class="content">
                            <div style="color:white" class="text">ADMINISTRACIÓN DE</div>
                            <div style="color:white" class="number">CONFIGURACIÓN</div>
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
