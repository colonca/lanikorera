<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show the view menu usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios()
    {
        return view('menu.usuarios')->with('location', 'usuarios');
    }

    public function almacen()
    {
        return view('menu.almacen')->with('location', 'almacen');
    }

    public function compras()
    {
        return view('menu.compras')->with('location', 'compras');
    }
    public function ventas()
    {
        return view('menu.ventas')->with('location', 'ventas');
    }

}
