<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $start = new DateTime('2020-07-27 10:00:00');
        $end = new DateTime('2020-07-27 11:00:00');
        
        for ($d = 0; $d < 1000; $d++){
            if($d % 7 == 0){
                $start->add(new DateInterval('P0Y0M1D'));
                $end->add(new DateInterval('P0Y0M1D'));
                continue ;
                }
                    for($i = 0; $i < 10; $i++){
                        
                    \Illuminate\Support\Facades\DB::table('events')->insert([
                    [
                        'title' => '◎',
                        'start' =>  $start,
                        'end' => $end,
                        'color' => '#e0e0de',
                        
                        
                    ]
                    ]);
                    $start->add(new DateInterval('P0Y0M0DT1H0M0S'));
                    $end->add(new DateInterval('P0Y0M0DT1H0M0S'));
                    }
            $start->add(new DateInterval('P0Y0M1D'));
            $start->sub(new DateInterval('P0Y0M0DT10H0M0S'));
            $end->add(new DateInterval('P0Y0M1D'));
            $end->sub(new DateInterval('P0Y0M0DT10H0M0S'));
       }
    }
}
