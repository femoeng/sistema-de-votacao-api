<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SmssyncMessage extends Model
{

    protected $fillable = ['id',"mensagem","send_to"];


}
