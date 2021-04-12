<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected $fillable = ['sku','nombre','presentacion','imagen','stock_minimo','stock_maximo','marca_id','subcategoria_id'];

    public function embalajes(){
        return $this->belongsToMany('App\Embalaje','producto_embalaje')
                ->withPivot('codigo_de_barras','unidades','precio_venta');
    }

    public static function search($code) {

        $producto =  DB::table('producto_embalaje')
            ->join('embalajes','producto_embalaje.embalaje_id','=','embalajes.id')
            ->join('productos','producto_embalaje.producto_id','=','productos.id')
            ->where('producto_embalaje.codigo_de_barras','=',$code)
            ->select(DB::raw('producto_embalaje.precio_venta as precio,unidades,nombre,presentacion,descripcion, producto_embalaje.id as unicode,codigo_de_barras, productos.id as producto'))
            ->first();

        if($producto){
            $existencias = DB::table('kardexes')
                ->select(DB::raw('sum(cantidad) as cantidad,tipo_movimiento'))
                ->where('producto_id',$producto->producto)
                ->groupBy('tipo_movimiento')
                ->get();

            $existencia = 0;
            foreach ($existencias as $item){
                switch ($item->tipo_movimiento){
                    case 'ENTRADA' :
                        $existencia += $item->cantidad;
                        break;
                    case 'SALIDA' :
                        $existencia -= $item->cantidad;
                        break;
                }
            }
            $producto->existencia_embalaje = intval($existencia / $producto->unidades);
            $producto->existencia =  $existencia;
            $producto->costo_promedio = Kardex::costo_promedio($producto->producto)*$producto->unidades;
        }

        return $producto;
    }


    public function marca() {
        return $this->belongsTo(Marcas::class,'marca_id');
    }


    public function  subcategoria(){
        return $this->belongsTo(Subcategoria::class,'subcategoria_id');
    }

}
