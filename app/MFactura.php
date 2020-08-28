<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MFactura extends Model
{
    protected $table = 'm_facturas';
    protected  $fillable = ['id', 'created_at', 'updated_at', 'serie', 'n_venta', 'fecha', 'modalidad_pago', 'medio_pago', 'total', 'estado','tipo','cliente_id'];

    public function cliente(){
        return $this->belongsTo(Clientes::class,'cliente_id');
    }

    public function dfactura(){
        return $this->hasMany(DFactura::class,'factura_id','id');
    }

    public function deudas(){
        return $this->hasMany(Deuda::class,'factura_id','id');
    }


    public function scopeSerie($query, $serie){
         if($serie)
              $query->where('serie',$serie);
    }

    public function scopeNumeroVenta($query, $numero){
        if($numero)
            $query->where('n_venta',$numero);
    }




}
