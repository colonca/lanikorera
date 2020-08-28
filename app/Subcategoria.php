<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    Protected $fillable = ['id','nombre'];

    public function categoria(){
        return $this->belongsTo('App\Categorias','categoria_id');
    }
    public function producto(){
        return $this->hasMany('App\producto','subcategoria_id');
    }
}
