<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Kardex extends Model
{
    protected $table = 'kardexes';
    protected $fillable = ['id', 'producto_id', 'bodega_id', 'tipo_movimiento', 'cantidad', 'costo', 'created_at', 'updated_at'];

    public static function costo_promedio($producto){
        //tiempo en meses
        $time = config('admin.tiempo_costo_promedio',3);
        $current = date('Y-m-d');
        $date = date("Y-m-d",strtotime($current."- $time month"));
        $costo = 0;
        $entradas = Kardex::where([
            ['tipo_movimiento','ENTRADA'],
            ['producto_id',$producto], 
            ['created_at', '>=', $date]
        ])->get();
        $cantidad = 0;
        $total  = 0;
        foreach ($entradas as $entrada){
           $total += $entrada->cantidad * $entrada->costo;
           $cantidad += $entrada->cantidad;
        }

        if($cantidad != 0){
            $costo = $total / $cantidad;
        }

        return $costo;
    }
}
