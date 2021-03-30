<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $fillable = ['id','nombre','nit','telefono','correo_electronico'];
}
