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

@endsection

