<?php

namespace App\Http\Controllers;

use App\Permisos;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function index(){
        $permisos = Permisos::all();
        $location = 'reportes';
        return view('reportes.permisos.permissions',compact('permisos','location'));
    }

}
