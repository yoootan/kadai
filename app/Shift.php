<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

    protected $fillable = ['shift'];


    public function nailist() {

    return $this->belongsTo('App\Nailist');

    }
}
