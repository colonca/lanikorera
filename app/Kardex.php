<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = 'kardexes';
    protected $fillable = ['id', 'producto_id', 'bodega_id', 'tipo_movimiento', 'cantidad', 'costo', 'created_at', 'updated_at'];
}
