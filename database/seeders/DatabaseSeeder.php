<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(UsersTableSeeder::class);
        //$this->call(CoursesTableSeeder::class);
        //$this->call(QuestionsTableSeeder::class);
        $this->call(ResponsesTableSeeder::class);
       // $this->call(EventsTableSeeder::class);
    }
}
