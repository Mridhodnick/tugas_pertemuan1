<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Event;

class PagesController extends Controller
{
    public function about(){
        return view('main.about');
    }
    public function events(){
        $events = Event::paginate(5);
        return view('main.events',compact('events'));
    }
    public function mainpage(){

        $students = User::where('role','students')->get();
        $trainers = User::where('role','trainers')->get();
        $events = Event::paginate(10);
        $courses = Course::all();        
        return view('main.index', compact('students','events', 'courses', 'trainers'));
    }

    public function register_as_trainers(){
        return view('auth.register_as_trainer');
    }

    
}
