<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Nailist;
use App\Menu;
use DateTime;
use DateInterval;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function admin_index(){
        
        $this->middleware('auth');

      

        $start = Event::find('id','start');
        $nailists = Nailist::get();
        $menus = Menu::get();

        $event = Event::first();

        if($event->reservations != 0){

            $event->color = '#fc7cd2';
        }

       
        
       

        return view('admin_index',compact('nailists','menus'));

    }

    public function admin_edit(){

        $nailists = Nailist::get();

        return view('admin_edit',compact('nailists'));
    }

    public function admin_store(Request $request){

        //休みの更新に必要なデータ
        $firstTime = $request->input('start');
        $firstTime = new Carbon($firstTime);

        $rest = $request->rest;

        $nailist_id = $request->input('nailist_id');

        $indexevent = Event::where('start',$firstTime)->first();

        $event_id = $indexevent->id;

       

        $nailist = Nailist::where('id',$nailist_id)->first();

        if( $rest == 1 ){
            for($i = 0 ; $i < 10 ; $i ++ ){
           
                $indexevent->nailists()->detach($nailist->id);

                $indexevent->nailists()->attach($nailist->id,['available' => 0]);

                $event_id ++;

                $indexevent = Event::where('id',$event_id)->first() ;

            }

        }elseif( $rest == 2){
            for($i = 0 ; $i < 8 ; $i ++){

                $indexevent->nailists()->detach($nailist->id);

                $indexevent->nailists()->attach($nailist->id,['available' => 1]);

                $event_id ++;

                $indexevent = Event::where('id',$event_id)->first() ;

            }
            for($i = 0 ; $i < 2 ; $i ++){

                $indexevent->nailists()->detach($nailist->id);

                $indexevent->nailists()->attach($nailist->id,['available' => 0]);

                $event_id ++;

                $indexevent = Event::where('id',$event_id)->first() ;
            }
            }elseif( $rest == 3){
                for($i = 0 ; $i < 2 ; $i ++){
    
                    $indexevent->nailists()->detach($nailist->id);
    
                    $indexevent->nailists()->attach($nailist->id,['available' => 0]);
    
                    $event_id ++;
    
                    $indexevent = Event::where('id',$event_id)->first() ;
    
                }
                for($i = 0 ; $i < 8 ; $i ++){
    
                    $indexevent->nailists()->detach($nailist->id);
    
                    $indexevent->nailists()->attach($nailist->id,['available' => 1]);
    
                    $event_id ++;
    
                    $indexevent = Event::where('id',$event_id)->first() ;
                }

        }

        return redirect('/admin_shift');
    }

    public function admin_test(){

        return view('/admin_test');
    }
  

  

    
}
