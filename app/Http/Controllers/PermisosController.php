<?php

namespace App\Http\Controllers;

use App\Permisos;

class PermisosController extends Controller
{
    public function index(){
        $permisos = Permisos::all();
        $location = 'reportes';
        return view('reportes.permisos.list',compact('permisos','location'));
    }

}
