<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    Protected $fillable = ['id','nombre'];

    public function  subcategorias(){
        return $this->hasMany(Subcategoria::class,'categoria_id');
    }
}
