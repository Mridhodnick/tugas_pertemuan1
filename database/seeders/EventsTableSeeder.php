<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('events')->truncate();

        $events =[]; 
        $faker = Factory::create();

        for($i=1; $i <=3; $i++){
            $date = date("Y-m-d H:i:s", strtotime("2021-06-17 10:00:00 + {$i} days "));
            $events[]=[
                'author_id' => 1,                
                'title'=> $faker->words(3,true),
                'schedule'=>$date,       
                'description'=>$faker->words(50,true),
                'created_at'=> $date,
                'updated_at'=>$date,
            ];
        }
        \DB::table('events')->insert($events);
    
    }
}
