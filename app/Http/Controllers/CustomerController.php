<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Nailist;
use App\Caution;
use App\Menu;
use App\Shift;
use App\Rest;
use App\ReservationEvent;
use App\EventNailist;
use App\CancelWaiting;
use App\Mail\CustomerConfirm;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ReservationEventRequest;
use App\Http\Requests\CancelRequest;




class CustomerController extends Controller
{
    public function customer_index(){

        $nailists = Nailist::get();
        
        $menus = Menu::get();

        $caution = Caution::first();


        return view('customer_index',compact('nailists','menus','caution'));
    }

    
    public function customer_create(Request $request)
    {
        $id = $request->input('id');
        
        $event = Event::where('id',$id)->first();

        $menus = Menu::get();

        $nailists = Event::find($id)->nailists()->where('event_nailist.available','1')->orderBy('id','asc')->get();
  
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

        return view('customer_confirm',compact('event','menu','nailist','price'));
    }
    public function customer_update(Request $request)
    {
        $request->session()->regenerateToken();

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

        $reserved->color = '#FFCCCC';

        if($reserved->reservations == 4){

            $reserved->title = '△';

            $reserved->color = '#FFFFCC';


        }elseif($reserved->reservations >= 5){

            $reserved->title = '×';

            $reserved->situation = '空きなし';

            $reserved->color = '#FF3366';


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

        $name = $event->name;
        $text = 'ご予約が確定いたしました';
        $to = [
            [
                'name' => $event->name,
                'email' => $event->email,
            ]
        ];
        Mail::to($to)->send(new CustomerConfirm($name, $text));
    

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

        $cancelEvent = Event::where('start',$event->start)->first();

        $cancelEvent->waitings ++ ;

        $cancelEvent->save();

        return view('customer_cancel_finish',compact('event','menu'));
    }

    public function customer_send_mail(){

        $name = 'ララベル太郎';
        $text = 'これからもよろしくお願いいたします。';
        $to = [
            [
                'name' => 'Laravel-rito',
                'email' => 'test@gmail.com'
            ]
        ];
        Mail::to($to)->send(new CustomerConfirm($name, $text));
    }
    /*public function customer_test(){

        $id = Nailist::find(3)->events()->first()->pivot->id;

        dd($id);

        $rests = Rest::get()->where('nailist_id',5);

        $reserved = ReservationEvent::where('nailist_id',5)->where('confirmed',1)->get();
      
        $nailist = Nailist::with(['events' => function($q){

            $q->where('start','2020-07-07 10:00:00');

        }])->get();

        $events = Event::with(['nailists' => function($q){

            $q->where('nailist_id', '=', 5);

        }])->select('start')->get()->toArray(); 

        $eventNailistCounts = Event::withCount('nailists')->where('id',100)->get();

        $reservedCount = ReservationEvent::get()->where('confirmed',1)->count('nailist_id',5);

        return view('customer_test',compact('events','nailist','eventNailistCounts','rests','reserved','reservedCount'));

    }*/

}
