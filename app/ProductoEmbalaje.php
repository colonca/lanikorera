<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoEmbalaje extends Model
{
    protected $table = 'producto_embalaje';
    protected $fillable = ['id', 'producto_id', 'embalaje_id', 'codigo_de_barras', 'unidades', 'precio_venta', 'created_at', 'updated_at'];

    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id','id');
    }

    public function embalaje(){
        return $this->belongsTo(Embalaje::class,'embalaje_id','id');
    }
    public function  descuentos(){
        return $this->hasMany(Descuento::class,'producto_embalaje_id');
    }
}
