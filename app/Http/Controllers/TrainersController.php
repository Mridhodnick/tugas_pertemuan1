<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\User;
use App\Models\Question;
use App\Models\Response;
use App\Models\Event;

class TrainersController extends Controller
{

    //fungsi proteksi halaman untuk membatasi akses pengguna
    public function __construct() {
        $this->middleware('auth');
    }

    //fungsi mengembalikan ke halaman dashboard
    public function index()
    {
        $users = User::paginate(10);
        $events = Event::paginate(10);
        $questions = Question::paginate(10);
        $courses = Course::paginate(10);
        return view('dashboard.trainers.trainers_dashboard',compact('users','events','questions','courses'));
    }

    //fungsi mengembalikan ke halaman form tambah materi
    public function create()
    {
        return view('dashboard.trainers.add_chapter');
    }

    //fungsi untuk menyimpan data dari form tambah materi ke database
    public function store(Request $request)
    {
        // fungsi ini menyimpan data store materi
        $course = new Course;
        $course->user_id =htmlspecialchars($request->user_id);
        $course->chapter_title = htmlspecialchars($request->chapter_title);
        $course->description = htmlspecialchars($request->description);
        $course->body = $request->body;

        $course->save();

        return redirect('/trainers/dashboard')->with('status',"Congratulations! A new chapter has added to this class!");

    }

    // fungsi untuk menyimpan data dari form question ke database
    public function create_discussions(Request $request)
    {
        $question = new Question;
        $question->author_id = htmlspecialchars($request->author_id);
        $question->questions= htmlspecialchars($request->new_question);
        $question->save();

        return redirect('/trainers/discussions')->with('update_message',"Your topics has been uploaded to the forum! Wait for a moment to see any response from another user.");

    }

    // fungsi create response
    public function create_responses(Request $request)
    {
        $response = new Response;
        $response->author_id = htmlspecialchars($request->author_id);
        $response->question_id = htmlspecialchars($request->question_id);
        $response->response= htmlspecialchars($request->new_response);
        $response->save();

        return redirect('/trainers/discussions')->with('update_message','Your response has been uploaded to the forum! Thankyou for participating in this discussion.');
    }


    //fungsi mengembalikan ke halaman form untuk update courses
    public function edit(Request $request)
    {
        $id = $request->course_id;
        $course = Course::find($id);
        return view('dashboard.trainers.edit_course', compact('course'));
    }

    //fungsi edit response
    public function edit_response(Request $request)
    {
        $id = $request->response_id;    
        $response = Response::find($id);

       return view('dashboard.trainers.update_response', compact('response'));
    }

     //fungsi edit question
     public function edit_question(Request $request)
     {
         $id = $request->question_id;    
         $question = Question::find($id);
 
        return view('dashboard.trainers.update_question', compact('question'));
     }

   //fungsi update courses
    public function update(Request $request)
    {
        Course::where('id', $request->course_id )->update(
        [
            'chapter_title' => htmlspecialchars($request->chapter_title),
            'description' => htmlspecialchars($request->description),
            'body' => htmlspecialchars($request->body),
        ]);
        
        return redirect('/trainers/dashboard')->with('status', 'Your class lesson has been edited!');
    }

    //fungsi update response
    public function store_updated_response(Request $request)
    {
        Response::where('id', $request->response_id )->update(
        [
            'response' => htmlspecialchars($request->new_response),
        ]);
         
        return redirect('/trainers/discussions')->with('update_message', 'Your response has been updated!');
    }

    //  fungsi update question
    public function store_updated_question(Request $request)
    {
        Question::where('id', $request->question_id )->update(
        [
            'questions' => htmlspecialchars($request->new_question),
        ]); 
         return redirect('/trainers/discussions')->with('update_message', 'Your discussion topic has been updated!');
    }
    
    //fungsi update profile trainers
    public function update_profile(Request $request)
    {
        $trainer = User::find($request->user_id);
        User::where('id', $request->user_id)->update([
            'name' => htmlspecialchars($request->name),
            'email' => htmlspecialchars($request->email),
            'status' =>htmlspecialchars($request->status),
        ]);

        //memeriksa inputan nama, email dan file gambar
        $this->validate($request, [
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|string|email|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        
       if($request->hasFile('image')){
        $location = public_path('assets2/img');
        $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
        $trainer->image = $request->file('image')->getClientOriginalName();
        $trainer->save();
       }

       return redirect('/trainers/dashboard')->with('status', 'Your profile has been updated!');

    }

    //fungsi delete courses
    public function destroy(Request $request)
    {
        $course_id = $request->course_id;
        $destroy_course = Course::find($course_id);
        $destroy_course->delete();
        return redirect('/trainers/dashboard')->with('delete_status', 'A course has been deleted!');
    }

    //fungsi delete response
    public function delete_response(Request $request)
    {
        $response_id = $request->response_id;
        $delete_this_response = Response::find($response_id);
        $delete_this_response->delete();

        return redirect('/trainers/discussions')->with('delete_status', 'Your response has been deleted!');
    }

    //fungsi delete question
    public function delete_question(Request $request)
    {
        $question_id = $request->question_id;
        $delete_this_question = Question::find($question_id);
        $delete_this_question->delete();

        return redirect('/trainers/discussions')->with('delete_status', 'Your question has been deleted!');
    }

    //fungsi menampilkan courses spesifik oleh trainer bersangkutan
    public function show_courses(){
        return view('dashboard.trainers.courses');
    }

    //fungsi read menampilkan data siswa
    public function class_attendee(){
        return view('dashboard.trainers.class_attendee');
    }

    //mengembalikan halaman diskusi
    public function show_discussions(){

        $questions = Question::paginate(3);
        return view('dashboard.trainers.discussions', compact('questions'));
    }

    //mengembalikan ke halaman profile trainers yang memiliki form update profile dan recent profile di sampingnya
    public function show_profile(){
        return view('dashboard.trainers.profile');
    }

    // fungsi cari course
    public function cari_course(Request $request){
        $results = Course::when($request->keyword_course, function ($query) use ($request) {
            $query  ->where('chapter_title', 'like', "%{$request->keyword_course}%")
                    ->orWhere('description', 'like', "%{$request->keyword_course}%")
                    ->orWhere('body', 'like', "%{$request->keyword_course}%");
        })->paginate(10);

        return view('dashboard.trainers.courses',compact('results'));
    }

    // fungsi cari user
    public function cari_user(Request $request){
        $results = User::when($request->keyword_user, function ($query) use ($request) {
            $query  ->where('name', 'like', "%{$request->keyword_user}%")
                    ->orWhere('email', 'like', "%{$request->keyword_user}%");
        })->paginate(10);

        return view('dashboard.trainers.class_attendee',compact('results'));
    }

}
