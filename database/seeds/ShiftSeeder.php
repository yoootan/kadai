<?php

use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $day = new DateTime('2020-07-28');
        $nailist_id = 1;

        
        for($d = 0 ; $d < 6 ; $d ++){
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
        $nailist_id ++;
           $day->sub(new DateInterval('P0Y0M1000D'));
    }
    }
  
}
