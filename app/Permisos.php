<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    protected $fillable = ['identificacion','nombre','operation','code','state','time','document'];
}
