<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DFactura extends Model
{
    protected $table = 'd_facturas';
    protected $fillable = [ 'id', 'producto_embalaje_id', 'cantidad', 'precio', 'created_at', 'updated_at' ];

    public function producto_embalaje(){
        return $this->belongsTo(ProductoEmbalaje::class,'producto_embalaje_id','id','producto_embalaje');
    }
}
