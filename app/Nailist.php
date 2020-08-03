<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nailist extends Model
{
    public $timestamps = false;

    protected $table = 'nailists';


    public function reservation_events() 
{
    return $this->hasMany('App\ReservationEvent');

}
    public function events() 
{
    return $this->belongsToMany('App\Event','event_nailist','nailist_id','event_id')->using('App\EventNailist')->withPivot('available');

}

public function rests()
{
    return $this->hasMany('App\Rest');
}
}