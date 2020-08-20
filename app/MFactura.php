<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function adicionales(){
        return $this->hasMany(Adicional::class,'factura_id','id');
    }


    public function scopeSerie($query, $serie){
         if($serie)
              $query->where('serie',$serie);
    }

    public function scopeNumeroVenta($query, $numero){
        if($numero)
            $query->where('n_venta',$numero);


        $deudas = DB::table('deudas')
             ->select('factura_id',DB::raw('sum(abono) as abonos,(total-sum(abono)) as resta'))
            ->groupBy('factura_id','total');


        $clientes = DB::table('clientes')
                      ->join('m_facturas','m_facturas.cliente_id','=','clientes.id')
                      ->joinSub($deudas,'deudas',function($join){
                          $join->on('m_facturas.id','=','deudas.factura_id');
                      })
                      ->select('clientes.id','clientes.identificacion','clientes.nombres','clientes.apellidos','m_facturas.total','deudas.abonos','deudas.resta')
                      ->where([
                          ['m_facturas.estado','=','EN DEUDA'],
                      ])
                      ->select('clientes.id','identificacion','nombres','apellidos',DB::raw('sum(total) as total, sum(abonos) as abonos, sum(resta) as resta'))
                      ->groupBy('clientes.id','identificacion','nombres','apellidos')
                      ->get();
        dd($clientes);
    }




}
