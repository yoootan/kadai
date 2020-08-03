<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\Nailist;

class EventNailistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $event_id = Event::first()->value('id');
        $nailist_id = Nailist::first()->value('id');
        $event_count = Event::count();
        $nailist_count = Nailist::count();


        for($d = 0 ; $d < $event_count ; $d++){

            for($i = 0; $i < $nailist_count ; $i ++){

                \Illuminate\Support\Facades\DB::table('event_nailist')->insert([

                    [
                        'event_id' => $event_id,
                        'nailist_id' => $nailist_id
                    ]
                        
                ]);
                $nailist_id ++;
            }
            $nailist_id -= Nailist::count();
            $i -= Nailist::count();
            $event_id ++;

        }
    
     }
}
