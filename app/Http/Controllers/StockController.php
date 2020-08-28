<?php

namespace App\Http\Controllers;

use App\Kardex;
use App\Producto;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stock(){

        $productos = Producto::all();
        $inventario = [];
        foreach ($productos as $producto){
            $stock = DB::table('kardexes')
                ->join('productos','productos.id','=','kardexes.producto_id')
                ->select('productos.id','productos.nombre','productos.presentacion','productos.stock_minimo','productos.stock_maximo','tipo_movimiento',DB::raw('sum(cantidad) as cantidad'))
                ->where('productos.id',$producto->id)
                ->groupBy('productos.id','productos.nombre','productos.presentacion','productos.stock_maximo','productos.stock_minimo','tipo_movimiento')
                ->orderBy('tipo_movimiento')
                ->get();

            if($stock->count() > 0){
                $item = new \stdClass();
                $item->producto = $stock[0]->nombre.'x'.$stock[0]->presentacion;
                $item->stock = ($stock[0]->cantidad??0) - ($stock[1]->cantidad ?? 0);
                $item->stock_minimo = $stock[0]->stock_minimo;
                $item->stock_maximo = $stock[0]->stock_maximo;
                $item->costo_promedio = Kardex::costo_promedio($producto->id);
                $inventario[] = $item;
            }
        }
        return view('reportes.stock.stock')->with('inventario',$inventario)->with('location','reportes');
    }

}
