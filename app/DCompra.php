<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DCompra extends Model
{
    protected $table = 'dcompras';
    protected $fillable = [ 'id', 'producto_embalaje_id', 'cantidad', 'costo','factura_id', 'created_at', 'updated_at'];


}
