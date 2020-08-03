<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

    public function nailist() {

    return $this->belongsTo('App\Nailist','shift_id');

    }
}
