<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    public $timestamps = false;
    

    public function reservation_events() 
    {
        return $this->hasMany('App\ReservationEvent');
    

    }
}