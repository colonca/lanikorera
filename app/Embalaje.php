<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Embalaje extends Model
{
    protected $fillable = ['id','descripcion'];

    public function productos(){
        return $this->belongsToMany('App\Producto','producto_embalaje')
            ->withPivot('codigo_de_barras','unidades','precio_venta');
    }

}
