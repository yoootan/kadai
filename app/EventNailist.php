<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventNailist extends Pivot
{
    protected $table = "event_nailist";

    protected $dates = ['start',];


}
