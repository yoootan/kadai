<?php

use Illuminate\Database\Seeder;

class NailistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1 ; $i < 6 ; $i ++){
        \Illuminate\Support\Facades\DB::table('nailists')->insert([
            [
               'name' => "nailist$i",
               'price' => 1000
            ]
        ]);

    }

    }
}
