<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $fillable = ['id', 'fecha_inicio', 'fecha_fin', 'cantidad_destinada', 'cantidad_vendida', 'valor', 'producto_embalaje_id', 'created_at', 'updated_at' ];

    public function producto_embalaje(){
        return $this->belongsTo(ProductoEmbalaje::class,'producto_embalaje_id','id','producto_embalaje');
    }

}
