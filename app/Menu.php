<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'name', 'price',
    ];
    

    public function reservation_events() 
    {
        return $this->hasMany('App\ReservationEvent');
    
    }
    public function cancel_waitings() 
    {
        return $this->hasMany('App\CancelWaiting');
    
    }

}