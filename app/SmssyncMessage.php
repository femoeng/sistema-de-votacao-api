<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmssyncMessage extends Model
{

    protected $fillable = ["from", "message","sent_to",
                            "sent_timestamp"];

}
