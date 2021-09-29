<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //\DB::table('questions')->truncate();
        
        $questions =[]; 
        $faker = Factory::create();

        for($i=1; $i <=10; $i++){
            $date = date("Y-m-d H:i:s", strtotime("2021-04-20 10:00:00 + {$i} days "));
            $questions[]=[
                'author_id' => rand(1,6),
                'questions'=> $faker->words(15,true),       
                'created_at'=> $date,
                'updated_at'=>$date,
            ];
        }
        \DB::table('questions')->insert($questions);
    }
}
