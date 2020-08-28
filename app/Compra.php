<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ['id', 'proveedor_id', 'bodega_id', 'total','serie','numero_venta', 'fecha', 'foto', 'created_at', 'updated_at'];
}
