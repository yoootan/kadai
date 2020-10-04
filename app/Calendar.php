<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
     protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = ['start',];

}
