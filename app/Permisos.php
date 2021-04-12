<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $fillable = ['identification','name','operation','code','state','time','document'];
}
