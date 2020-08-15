<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DCompra extends Model
{
    protected $table = 'Dcompras';
    protected $fillable = [ 'id', 'producto_embalaje_id', 'cantidad', 'costo', 'created_at', 'updated_at' ];
}
