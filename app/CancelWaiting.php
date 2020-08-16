<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelWaiting extends Model
{
    protected $fillable = ['id','name','start','menu_id','email','tel'];

    protected $dates = [
        'start'
    ];

    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }
}
