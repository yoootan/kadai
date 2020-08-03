<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


    protected $fillable = ['id','title','nailist_id','start','end','color','description','menu_id'];

    protected $table = 'events';


    public function nailists(){

        return $this->belongsToMany('App\Nailist');


    }

    public function getStartAttribute($value)
    {
        $dateStart = Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('Y-m-d');
        $timeStart = Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('H:i:s');

        return $this->start =($timeStart == '00:00:00' ? $dateStart : $value);
    }
    public function getEndAttribute($value)
    {
        $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('Y-m-d');
        $timeEnd = Carbon::createFromFormat('Y-m-d H:i:s',$value)->format('H:i:s');

        return $this->end =($timeEnd == '00:00:00' ? $dateEnd : $value);
    }
}
