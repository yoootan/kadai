<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function loadEvents()
    {
        $events = Event::get();


        return response()->json($events);

    }

    public function store(EventRequest $request){

        Event::create($request->all());

        return response()->json(true);
    }

    public function update(Request $request){

        $event = Event::where('id',$request->id)->first();

        

        $event->fill($request->all());



        $event->save();

        return response()->json(true);
    }

    public function destroy(Request $request){

        Event::where('id',$request->id)->delete();

        return response()->json(true);
    }

        
}
