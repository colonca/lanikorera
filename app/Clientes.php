<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
   protected $fillable = ['id','identificacion','nombres','apellidos','telefono','email'];
}
