<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Nailist;
use App\Caution;
use App\Menu;
use App\Shift;
use App\ReservationEvent;
use App\CancelWaiting;
use DateTime;
use DateInterval;
use Carbon\Carbon;
use DB;


class AdminController extends Controller
{
    public function admin_index(){

       
        
        $this->middleware('auth');

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;
      
        $start = Event::find('id','start');

        $nailists = Nailist::get();

        $menus = Menu::get();

        $event = Event::first();

        if($event->reservations != 0){

            $event->color = '#fc7cd2';
        }
        return view('admin_index',compact('nailists','menus','month','year'));
    }

    public function admin_edit(){

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;

        $nailists = Nailist::get();

        return view('admin_edit',compact('nailists','year','month'));
    }

    public function admin_reserved_show(Request $request,$id){

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;

        if ( $request->input('reserved')){

        $start = $request->input('start');

        $event = Event::where('start',$start)->first();

        $reservedEvents = ReservationEvent::with(['nailist','menu'])->where('start',$start)->where('confirmed',1)->get();

        return view('/admin_reserved_show',compact('reservedEvents','start','event','year','month'));

        }elseif($request->input('cancel')){

            $start = $request->input('start');

            $cancelEvents = CancelWaiting::with('menu')->where('start',$start)->get();

            return view('/admin_cancel_show',compact('cancelEvents','start','year','month'));
        }
    }

    public function admin_create_menu(){

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;

        $menus = Menu::get();

        return view('/admin_create_menu',compact('year','month','menus'));
    }

    public function admin_store_menu(Request $request){

        $menu = Menu::create($request->all());

        return redirect()->back();
    }

    public function admin_edit_caution(){

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;

        $text = Caution::first()->text;

        return view('/admin_edit_caution',compact('year','month','text'));
    }

    public function admin_update_caution(Request $request){

        $caution = Caution::first();

        $text = $request->text;

        $caution->text = $text;

        $caution->save();

        session()->flash('message', '変更しました。');

        return redirect()->back();
    }

    public function admin_create_nailist(){

        $today = Carbon::now();

        $year = $today->year;

        $month = $today->month;

        $nailists = Nailist::get();

        return view('/admin_create_nailist',compact('year','month','nailists'));
    }
    public function admin_store_nailist(Request $request){

        $nailist = Nailist::create($request->all());

        $nailist_id = $nailist->id;

        $event_id = Event::first()->value('id');

        $event_count = Event::count();

        $day = new DateTime('2020-07-28');

        for($d = 0 ; $d < $event_count ; $d++){
          \Illuminate\Support\Facades\DB::table('event_nailist')->insert([

            [
                'event_id' => $event_id,
                'nailist_id' => $nailist_id
            ]     
          ]); 
            $event_id ++;
        }

        for($i = 1 ; $i < 1001 ;$i ++ ){
          
            if($i % 7 == 0){
 
             \Illuminate\Support\Facades\DB::table('shifts')->insert([
                 [
                     'day' => $day,
                    'nailist_id' => $nailist_id, 
                    'shift' => 1, 
                 ]
                 ]);
                 $day->add(new DateInterval('P0Y0M1D'));
 
            }else{
             \Illuminate\Support\Facades\DB::table('shifts')->insert([
                 [
                     'day' => $day,
                 'nailist_id' => $nailist_id,  
                 ]
                 ]);
                 $day->add(new DateInterval('P0Y0M1D'));
 
            }
         } 

        return redirect()->back();
    }

    public function admin_management(Request $request){

        $month = $request->month;

        $year = $request->year;
        
        if($month == 12){
           
            $nextYear = $year + 1;
            $nextMonth = 1;

        }else{
            $nextYear = $year;
            $nextMonth = $month + 1;
        }

        if($month == 1){
           
            $backYear = $year - 1;
            $backMonth = 12;

        }else{
            $backYear = $year;
            $backMonth = $month - 1;
        }

        $today = Carbon::today();

        $monthStart = $today->setDate($year,$month,1);

        $array = [1,3,5,7,8,10,12];

        if(in_array($month,$array)){
            $dayEnd = 31;
        }elseif($month == 2){
            $dayEnd = 28;
        }else{
            $dayEnd = 30;
        }

        setlocale(LC_ALL, 'ja_JP.UTF-8');

        for($d = 0 ; $d < $dayEnd ; $d ++){

            $dates[] = $monthStart->formatLocalized('%a');

            $monthStart->add(new DateInterval('P0Y0M1D'));

        }

       $nailistCount = Nailist::count();

       
       $shifts = Shift::whereYear('day',$year)->whereMonth('day',$month)->get();


       $shifts = $shifts->groupBy('nailist_id');


       $nailists = Nailist::get();

       foreach($nailists as $nailist){

           $nailists_ids[] = [$nailist->id,$nailist->name];
       }

        return view('/admin_management',compact('nailists','month','dayEnd','year','nextMonth','nextYear','backYear','backMonth','shifts','nailists_ids','dates'));
    }

    public function admin_management_store(Request $request){
        
        $month = $request->month;

        $year = $request->year;

        $day = $request->monthDay;

        $today = Carbon::today();

        $getMonday = $today->copy()->setDate($year,$month,$day)->startOfWeek();

        $firstTime = $today->copy()->setDate($year,$month,$day);

        if($getMonday == $firstTime){

            session()->flash('message', '月曜日は定休日です');

            return redirect()->back();

        }else{

            $firstTime->addHours(10);
        }
        
        $nailist_id = $request->nailist_id;

        $shift = $request->shift;

        $rest = $request->rest;

        $indexevent = Event::where('start',$firstTime)->first();

        $event_id = $indexevent->id;

        $nailist = Nailist::where('id',$nailist_id)->first();

        if( $rest == 0){
            for($i = 0 ; $i < 10 ;$i ++){

                $indexevent->nailists()->detach($nailist->id);

                $indexevent->nailists()->attach($nailist->id,['available' => 1]);

                $event_id ++;

                $indexevent = Event::where('id',$event_id)->first() ;
            }
        }
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
        $todayTime = $today->setDate($year,$month,$day);

         Shift::where('day',$todayTime)->where('nailist_id',$nailist_id)->first()->update(['shift' => $rest]);

        return redirect()->back();

    }

    public function admin_reserved_delete($id){

        $reservedEvent = ReservationEvent::where('id',$id)->first();

        $reservedNailist = Nailist::where('id',$reservedEvent->nailist_id)->first();

        $customerEvent = Event::where('start',$reservedEvent->start)->first();

        $customerEvent->reservations -= 1;

        $reservations = $customerEvent->reservations;

        $customerEvent->nailists()->detach($reservedNailist->id);

        $customerEvent->nailists()->attach($reservedNailist->id,['available' => 1]);

        $reservedEvent->delete();

        if($reservations == 4){

            $customerEvent->title = '△';

            $customerEvent->color = '#FFFFCC';

        }elseif($reservations == 3){

            $customerEvent->title = '◎';

            $customerEvent->color = '#FFCCCC';

        }elseif($reservations == 0){

            $customerEvent->color = '#e0e0de';

        }

        $customerEvent->save();
        
        return redirect()->back();

    }

    public function admin_menu_delete($id){

        Menu::where('id',$id)->delete();

        return redirect()->back();

    }
    public function admin_nailist_delete($id){

        Nailist::where('id',$id)->delete();

        return redirect()->back();

    }
    
}
