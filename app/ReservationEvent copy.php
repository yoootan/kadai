<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationEvent extends Model
{


    protected $fillable = ['id','name','nailist_id','start','menu_id','email','tel','note','confirmed'];

    public $timestamps = false;


}
