<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalidasController extends Controller
{
    public function salidas(Request $request){

        $fecha_inicial = $request->has('fecha_inicial') ? $request->fecha_inicial : date('Y-m-d');
        $fecha_final = $request->has('fecha_final') ? $request->fecha_final : date('Y-m-d') ;
        

        $salidas = DB::table('kardexes')
            ->join('productos', 'productos.id', '=', 'kardexes.producto_id')
            ->select('productos.id', 'productos.nombre', 'productos.presentacion', 'tipo_movimiento', DB::raw('sum(cantidad) as cantidad'))
            ->where('tipo_movimiento','SALIDA')
            ->whereBetween('kardexes.fecha',[$fecha_inicial,$fecha_final])
            ->groupBy('productos.id', 'productos.nombre', 'productos.presentacion', 'tipo_movimiento')
            ->get();


        return view('reportes.salidas.salidas')->with('salidas', $salidas)->with('location', 'reportes');
    }
}
