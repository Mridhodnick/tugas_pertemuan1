<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class ResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('responses')->truncate();
        
        $responses =[]; 
        $faker = Factory::create();

        for($i=1; $i <=50; $i++){
            $date = date("Y-m-d H:i:s", strtotime("2021-04-20 10:00:00 + {$i} days "));
            $responses[]=[
                'question_id' => rand(1,8),
                'author_id'=>rand(1,6),
                'response'=> $faker->words(30,true),       
                'created_at'=> $date,
                'updated_at'=>$date,
            ];
        }
        \DB::table('responses')->insert($responses);
    }
}
