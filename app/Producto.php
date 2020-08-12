<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['sku','nombre','presentacion','imagen','stock_minimo','stock_maximo','marca_id','subcategoria_id'];

    public function embalajes(){
        return $this->belongsToMany('App\Embalaje','producto_embalaje')
                ->withPivot('codigo_de_barras','unidades','precio_venta');
    }


    public function marca() {
        return $this->belongsTo(Marcas::class,'marca_id');
    }


    public function  subcategoria(){
        return $this->belongsTo(Subcategoria::class,'subcategoria_id');
    }

}
