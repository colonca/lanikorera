<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAT</title>
    <link href='https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,400italic,300italic,300|Raleway:300,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/animate.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logomi.png')}}">
</head>
<body>
<div class="content">
    <div class="container wow fadeInUp delay-03s">
        <div class="row">
            <div class="logo text-center">
                <img src="{{asset('img/logo.png')}}" alt="logo" width="350">
                <h2>Bienvenido!</h2>
                <h3>LA NIKORERA-Liquor store</h3>
            </div>
        </div>
    </div>
    <section style="padding-top: 20px;">
        <div class="container">
            <div class="row text-center">
                <div>
                    <a href="{{ url('/login') }}" class="btn btn-danger"><i class="fa fa-sign-in"></i> Ingresar</a>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row bort">
                <div class="copyright">
                    © 2020 La Nikorera. Todos los Derechos Reservados.
                    <div class="credits">Desarrollado por <a href="#">Alberto Rojas</a> & <a href="#">Camilo Colon</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery.ui.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/wow.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>
</body>
</html>
