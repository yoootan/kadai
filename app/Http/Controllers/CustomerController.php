<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use My_func;

use App\Event;
use App\Nailist;
use App\Menu;
use App\Shift;
use App\Rest;
use App\ReservationEvent;
use App\EventNailist;
use App\CancelWaiting;
use App\Http\Requests\ReservationEventRequest;
use App\Http\Requests\CancelRequest;



class CustomerController extends Controller
{
    public function customer_index(){

      
        $nailists = Nailist::get();
        $menus = Menu::get();
        

        return view('customer_index',compact('nailists','menus'));

    }

    
    public function customer_create(Request $request)
    {

        $id = $request->input('id');
        
        
        $event = Event::where('id',$id)->first();

        $menus = Menu::get();

        $nailists = Event::find($id)->nailists()->where('event_nailist.available','1')->get();

        
       // $nailistAll = Nailist::with('events')->get();

        //$rests = Rest::get();

        //$reserved = ReservationEvent::where('confirmed',1)->get();

        return view('customer_create',compact('event','menus','nailists'));

    }
    

    public function customer_store(ReservationEventRequest $request)
    {

        $validated = $request->validated();

       

        $event = ReservationEvent::create($request->all());
       

        $event = ReservationEvent::orderBy('id','desc')->first();

        $menu_id = $event->menu_id;

        $nailist_id = $event->nailist_id;

        $nailist = Nailist::where('id',$nailist_id)->first();


        $menu = Menu::where('id',$menu_id)->first();

        if($nailist == null){
            $price = $menu->price;
        }else{
            $price = $nailist->price + $menu->price;
        }


       


        //return response()->json($event);
        return view('customer_confirm',compact('event','menu','nailist','price'));


    }
    public function customer_update(Request $request)
    {

        $id = $request->input('id');

        $start = $request->input('start');

        $price = $request->input('price');

        $event = ReservationEvent::where('id', $id)->first();

        $event->fill($request->all());

        $event->confirmed ='1';

        $event->price = $price;

        $event->save();

        $reserved = Event::where('start',$start)->first();

        $reserved->reservations ++;

        if($reserved->reservations == 4){

            $reserved->title = '△';

        }elseif($reserved->reservations >= 5){

            $reserved->title = '×';

            $reserved->situation = '空きなし';

        }else{

            $reserved->title = '◎';
        }

        $reserved->save();

        $menu_id = $event->menu_id;

        $nailist_id = $event->nailist_id;

        $indexevent = Event::where('start',$start)->first();

        $nailist = Nailist::where('id',$nailist_id)->first();

        if(!empty($nailist)){
            $indexevent->nailists()->detach($nailist->id);

            $indexevent->nailists()->attach($nailist->id,['available' => 0]);
        }

        $menu = Menu::where('id',$menu_id)->first();


        return view('customer_finish',compact('event','menu','nailist'));

    
    }

    public function customer_finish(Request $request){

        return view('customer_finish');


    }
    public function customer_cancel(Request $request){

        $event = Event::where('id',$request->id)->first();

        $menus = Menu::get();
       


        return view('customer_cancel',compact('event','menus'));

    }

    public function customer_cancel_store(CancelRequest $request){

        $event = CancelWaiting::create($request->all());

        $menu_id = $event->menu_id;

        $menu = Menu::where('id',$menu_id)->first();



        return view('customer_cancel_finish',compact('event','menu'));


    }
    public function customer_test(){

        $id = Nailist::find(3)->events()->first()->pivot->id;

        dd($id);

        $rests = Rest::get()->where('nailist_id',5);

        $reserved = ReservationEvent::where('nailist_id',5)->where('confirmed',1)->get();

        //$nailist = Nailist::with('events')->where('id',5)->first();
        //$event = Event::where('start','2020-07-07 15:00:00')->first();
      
        $nailist = Nailist::with(['events' => function($q){

            $q->where('start','2020-07-07 10:00:00');

        }])->get();


       


       //ネイリスト５のイベントのstart一覧を取得
        $events = Event::with(['nailists' => function($q){

            $q->where('nailist_id', '=', 5);

        }])->select('start')->get()->toArray(); 

   



      


        //$users = \App\User::with(['contacts' => function($q){

           // $q->where('created_at', '>', '2018-07-01');
        
       // }])->get();




        $eventNailistCounts = Event::withCount('nailists')->where('id',100)->get();
        //id１００のイベントに所属するネイリストの数


        
        //休みの日テーブルから休みの日一覧を取得
        $reservedCount = ReservationEvent::get()->where('confirmed',1)->count('nailist_id',5);

       

        //$result = array_diff($events, $reserved);

        //dd($result);


        return view('customer_test',compact('events','nailist','eventNailistCounts','rests','reserved','reservedCount'));

    }

}
