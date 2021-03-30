<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DCompra extends Model
{
    protected $table = 'dcompras';
    protected $fillable = [ 'id', 'producto_embalaje_id', 'cantidad', 'costo','factura_id', 'created_at', 'updated_at'];

    public function producto_embalaje(){
        return $this->belongsTo(ProductoEmbalaje::class,'producto_embalaje_id','id','producto_embalaje');
    }

}
