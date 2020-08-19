<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MFactura extends Model
{
    protected $table = 'm_facturas';
    protected  $fillable = ['id', 'created_at', 'updated_at', 'serie', 'n_venta', 'fecha', 'modalidad_pago', 'medio_pago', 'total', 'cliente_id'];

    public function cliente(){
        return $this->belongsTo(Clientes::class,'cliente_id');
    }

    public function dfactura(){
        return $this->hasMany(DFactura::class,'factura_id','id');
    }

    public function adicionales(){
        return $this->hasMany(Adicional::class,'factura_id','id');
    }

}
