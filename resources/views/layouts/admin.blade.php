<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{asset('img/logomi.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{asset('css/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/node-waves/waves.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/plugins/animate-css/animate.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{asset('js/chosen/chosen.css')}}"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet"/>
    <!-- JQuery DataTable Css -->
    <link href="{{asset('css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33bf1ad68d.js" crossorigin="anonymous"></script>
    <!-- JQuery Nestable Css -->
    <link href="{{asset('css/plugins/nestable/jquery-nestable.css')}}" rel="stylesheet"/>

    @yield('style')
</head>
<body class="theme-teal">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Por Favor Espere...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!--         Search Bar
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="ESCRIBA AQUÍ...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>-->
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar" style="background-color:rgb(0, 0, 0);">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{route('inicio')}}">{{ config('app.name') }} - LIQUOR STORE</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!--<li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>-->
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">notifications</i>
                        <span class="label-count">{{session()->get('total')}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">NOTIFICACIONES</li>
                        <li class="body">
                            <ul class="menu">
                                @if(session()->get('total')>0)
                                    @foreach(session()->get('notificaciones') as $n)
                                        <li>
                                            <a href="{{$n->action}}">
                                                <div class="icon-circle bg-light-green">
                                                    <i class="material-icons">{{$n->icono}}</i>
                                                </div>
                                                <div class="menu-info">
                                                    <h4>{{$n->titulo}}</h4>
                                                    <p>
                                                        <i class="material-icons">access_time</i> {{$n->fecha}}
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{route('notificaciones.index')}}">Ver todas las notificaciones</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <!--<li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>-->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{asset('img/user.png')}}" width="48" height="48" alt="User"/>
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true"
                     aria-expanded="false">{{Auth::user()->nombres}} {{Auth::user()->apellidos}}</div>
                <div class="email">{{session('ROL')}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{route('inicio')}}"><i class="material-icons">home</i>Inicio</a></li>
                        <li role="seperator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="material-icons">input</i>Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENÚ PRINCIPAL</li>
                @if(session()->exists('MOD_INICIO'))
                    @if($location=='inicio')
                        <li class="active"><a href="{{route('inicio')}}"><i
                                    class="material-icons">home</i><span>Inicio</span></a></li>
                    @else
                        <li><a href="{{route('inicio')}}"><i class="material-icons">home</i><span>Inicio</span></a></li>
                    @endif
                @endif
                @if(session()->exists('MOD_USUARIOS'))
                    @if($location=='usuarios')
                        <li class="active"><a href="{{route('admin.usuarios')}}"><i
                                    class="material-icons">person</i><span>Usuarios</span></a></li>
                    @else
                        <li><a href="{{route('admin.usuarios')}}"><i
                                    class="material-icons">person</i><span>Usuarios</span></a></li>
                    @endif
                @endif
                @if(session()->exists('MOD_ALMACEN'))
                    @if($location=='almacen')
                        <li class="active"><a href="{{route('admin.almacen')}}"><i
                                    class="material-icons">storefront</i><span>Almacen</span></a></li>
                    @else
                        <li><a href="{{route('admin.almacen')}}"><i
                                    class="material-icons">storefront</i><span>Almacen</span></a></li>
                    @endif
                @endif
                @if(session()->exists('MOD_COMPRAS'))
                    @if($location=='compras')
                        <li class="active"><a href="{{route('admin.compras')}}"><i
                                    class="material-icons">style</i><span>Compras</span></a></li>
                    @else
                        <li><a href="{{route('admin.compras')}}"><i
                                    class="material-icons">style</i><span>Compras</span></a></li>
                    @endif
                @endif
                @if(session()->exists('MOD_VENTAS'))
                    @if($location=='ventas')
                        <li class="active"><a href="{{route('admin.ventas')}}"><i
                                    class="material-icons">import_contacts</i><span>Ventas</span></a></li>
                    @else
                        <li><a href="{{route('admin.ventas')}}"><i
                                    class="material-icons">import_contacts</i><span>Ventas</span></a></li>
                    @endif
                @endif
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="material-icons">input</i><span>Salir</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2020 LA NIKORERA. Todos los Derechos Reservados. <a href="javascript:void(0);">AdminBSB - Material De
                    sign</a>.
                </d
                iv>
                <div class="version">
                    <b>Desarrollado Por: </b> <a href="#">SKAYNET</a>
                </div>
            </div>
            <!-- #Footer -->
    </aside>
</section>
<section class="content">
    @yield('breadcrumb')
    <div class="container-fluid">
        <div class="block-header">
            <div class="col-md-12">
                @include('flash::message')
            </div>
            @yield('content')
        </div>
    </div>
</section>

<script src="{{asset('js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('js/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/node-waves/waves.js')}}"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('js/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('js/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script src="{{asset('js/chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{ asset('plugins/pnotify/dist/pnotify.js')}}"></script>
<script src="{{ asset('plugins/pnotify/dist/pnotify.buttons.js')}}"></script>
<script src="{{ asset('plugins/pnotify/dist/pnotify.nonblock.js')}}"></script>
<script src="{{ asset('plugins/pnotify/dist/pnotify.nonblock.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('select2/dist/js/select2.full.min.js')}}"></script>
<!-- Jquery Validation Plugin Css -->
<script src="{{ asset('js/jquery-validation/jquery.validate.js')}}"></script>
<!-- JQuery Steps Plugin Js -->
<script src="{{ asset('js/jquery-steps/jquery.steps.js')}}"></script>
<script src="{{ asset('js/pages/forms/form-wizard.js')}}"></script>
<!-- TinyMCE -->
<script src="{{ asset('js/tinymce/tinymce.js')}}"></script>
<!-- Jquery Nestable -->
<script src="{{ asset('js/nestable/jquery.nestable.js')}}"></script>
<script src="{{ asset('js/pages/ui/sortable-nestable.js')}}"></script>
<script type="text/javascript">

    var url = "<?php echo config('app.url'); ?>/";

    function copiar(text) {
        $("body").append("<input type='text' id='temp'>");
        $("#temp").val(text).select();
        document.execCommand("copy");
        $("#temp").remove();
        notify("Información", "Ha Copiado el enlace al portapapeles", "info");
    }

    function notify(title, text, type) {
        new PNotify({
            title: title,
            text: text,
            type: type,
            styling: 'bootstrap3'
        });
    }
</script>
@yield('script')
</body>
</html>
