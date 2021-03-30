<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = ['id','prefijo','inicial','final','actual','estado'];
}
