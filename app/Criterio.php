<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    protected $fillable = ['nome'];
    public $incrementing = false;
}
