<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


    protected $fillable = ['id','title','nailist_id','start','end','color','description','menu_id'];

    public $timestamps = false;

    protected $dates = ['start',];

    protected $table = 'events';

    


    public function nailists(){

        return $this->belongsToMany('App\Nailist');


    }


}
