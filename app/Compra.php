<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ['id', 'proveedor_id', 'bodega_id', 'total','serie', 'fecha', 'foto', 'created_at', 'updated_at'];

    public function proveedor(){
        return $this->belongsTo(Proveedores::class,'proveedor_id');
    }
    public function bodega(){
        return $this->belongsTo(Bodegas::class,'bodega_id');
    }
}
