<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
   protected $fillable = ['id','identificacion','nombres','apellidos','telefono','email'];

   public function facturas(){
       return $this->hasMany(MFactura::class,'cliente_id','id');
   }

}
