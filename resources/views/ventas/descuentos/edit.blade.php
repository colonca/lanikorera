@extends('layouts.admin')
@section('breadcrumb')
    <ol class="breadcrumb" style="margin-bottom: 30px; background-color: #38383A">
        <li><a style="color:white" href="{{route('inicio')}}">Inicio</a></li>
        <li><a style="color:white"href="{{route('admin.ventas')}}">Ventas</a></li>
        <li class="active"><a style="color:white" href="{{route('descuentos.index')}}">Descuentos</a></li>
        <li class="active"><a style="color:white" href="">Editado Descuento </a></li>
    </ol>
@endsection
@section('style')
    <style>
        .form-line {
            margin-bottom: 10px;
        }
        #loader {
            display: block;
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 100000;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        #myDiv {
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: black;
            opacity: 0.8;
            z-index: 1000;
        }
    </style>
@endsection
@section('content')
    <livewire:ventas.descuentos.descuento-update id="{{$descuento->id}}"/>
@endsection
