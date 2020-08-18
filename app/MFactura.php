<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MFactura extends Model
{
    protected $table = 'm_facturas';
    protected  $fillable = ['id', 'created_at', 'updated_at', 'serie', 'n_venta', 'fecha', 'modalidad_pago', 'medio_pago', 'total', 'cliente_id'];
}
