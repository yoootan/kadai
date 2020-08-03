<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationEvent extends Model
{


    protected $fillable = ['id','name','nailist_id','start','menu_id','email','tel','note','confirmed','price'];

    public $timestamps = false;

   
    

    public function nailist() 
{
    return $this->belongsTo('App\Nailist');
}
    public function menu() 
{
    return $this->belongsTo('App\Menu');
}


}
