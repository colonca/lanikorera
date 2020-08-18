<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DFactura extends Model
{
    protected $table = 'd_facturas';
    protected $fillable = [ 'id', 'producto_embalaje_id', 'cantidad', 'precio', 'created_at', 'updated_at' ];

}
