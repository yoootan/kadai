<?php

namespace App\Lib;

use App\Event;
use App\Nailist;
use App\Menu;
use App\Shift;
use App\Rest;
use App\ReservationEvent;


class My_func
{
  public static function getNailistShift($id)
  {
    
    $rests = Rest::get()->where('nailist_id',$id);

   

    $reserved = ReservationEvent::where('nailist_id',$id)->where('confirmed',1)->get();

    $nailist = Nailist::with('events')->where('id',$id)->first();

        foreach($nailist->events as $e){
            foreach($rests as $rest){
                if( $e->start >= $rest->start && $e->end <= $rest->end){
                break;
                }  
            }
        foreach($reserved as $r){

            if( $e->start == $r->start){
                break;

            }
        }   

        if( $e->start != $r->start){
            if( $e->start < $rest->start || $e->end > $rest->end){

           
               echo $e->start;

            }
        }
    }


  
  }
}