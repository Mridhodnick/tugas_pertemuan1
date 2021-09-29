<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //kosongkan semua data di tabel courses
        \DB::table('courses')->truncate();
        
        //membangkitkan 5 data dummy di table courses
        $courses =[]; //inisialisasi variabel posts untuk menampung data
        $faker = Factory::create();

        for($i=1; $i <=20; $i++){
            $date = date("Y-m-d H:i:s", strtotime("2021-04-20 10:00:00 + {$i} days "));
            $courses[]=[
                'user_id' => rand(2,5), //buat angka random dari 1-3
                'chapter_title' =>$faker->words(5,true), 
                'description'=> $faker->words(50,true),       
                'body'=>$faker->paragraph(rand(8,12),true),
                'created_at'=> $date,
                'updated_at'=>$date,
            ];
        }
        \DB::table('courses')->insert($courses);
    }
}
