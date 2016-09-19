<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class smssync_message extends Model
{

    protected $fillable = ["from", "message","sent_to",
                            "device_id","sent_timestamp"];

}
