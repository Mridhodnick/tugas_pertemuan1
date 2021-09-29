<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0');
 
         //membuat 3 user secara manual
         DB::table('users')->insert([
             [
                 'name'=>"Monika Panjaitan",
                 'email'=>"monikapanjaitan@gmail.com",
                 'password'=>bcrypt('rahasia1'),
                 'role'=>'admin',
             ],
             [
                'name'=>"Pahwana Sinulingga",
                'email'=>"pahwana@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'admin',
             ],
             [
                'name'=>"Muhammad Ridho Damanik",
                'email'=>"ridhodamanik@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'admin',
             ],
             [
                'name'=>"Ridho Atim",
                'email'=>"ridhoatim@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'admin',
             ],
             [
                'name'=>"Tsabitah Muflihza",
                'email'=>"tsabitah@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'admin',
             ],
             [
                'name'=>"Kelompok 5",
                'email'=>"kelompok5@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'admin',
             ],
         ]);
 
    }
}
