<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    public function nailist()
    {
        return $this->belongsTo('App\Nailist');
    }
}
