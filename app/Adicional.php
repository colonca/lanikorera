<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $table = 'adicionals';
    protected $fillable = ['id','nombre','precio_compra','precio_venta'];
}
