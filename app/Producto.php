<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['sku','nombre','presentacion','imagen','stock_minimo','stock_maximo'];

    public function embalajes(){
        return $this->belongsToMany('App\Embalajes','producto_embalaje')
                ->withPivot('codigo_de_barras','unidades','precio_venta');
    }

}
