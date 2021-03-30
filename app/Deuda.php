<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    protected $fillable = ['id', 'estado', 'total', 'abono', 'factura_id', 'created_at', 'updated_at'];
    protected $table = 'deudas';

    public function factura(){
        return $this->belongsTo(MFactura::class,'factura_id');
    }
}
