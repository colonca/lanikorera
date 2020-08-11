<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    Protected $fillable = ['id','nombre','descripcion'];

    public function categoria(){
        return $this->belongsTo('App\Categorias','categoria_id');
    }
}
