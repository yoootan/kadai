<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caution extends Model
{
    public $timestamps = false;

    protected $fillable = ['text'];

}