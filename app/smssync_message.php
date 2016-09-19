<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class smssync_message extends Model
{

    protected $fillable = ["smssync_to", "smssync_from","smssync_message_text",
                            "smssync_message_date","smssync_sent","smssync_sent_date"];

}
