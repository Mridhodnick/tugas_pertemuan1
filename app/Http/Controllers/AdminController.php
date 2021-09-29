<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Response;
use App\Models\Course;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //fungsi ini bertujuan untuk mengatur autorisasi berdasarkan role user
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $questions = Question::paginate(10);
        $users     = User::paginate(10);
        $courses = Course::paginate(10);
        $events = Event::paginate(10);
        return view('dashboard.admin.admin_dashboard',compact('questions','events','users','courses'));
    }

    public function show_discussions(){
        $questions = Question::paginate(3);
        return view('dashboard.admin.discussions', compact('questions'));
    }

    // fungsi untuk menyimpan data dari form question ke database
    public function create_discussions(Request $request)
    {
        $question = new Question;
        $question->author_id = htmlspecialchars($request->author_id);
        $question->questions= htmlspecialchars($request->new_question);
        $question->save();

        return redirect('/admin/discussions')->with('update_message',"Your topics has been uploaded to the forum! Wait for a moment to see any response from another user.");

    }

    //fungsi edit question
    public function edit_question(Request $request)
    {
        $id = $request->question_id;    
        $question = Question::find($id);

       return view('dashboard.admin.update_question', compact('question'));
    }

    //  fungsi update question
    public function store_updated_question(Request $request)
    {
        Question::where('id', $request->question_id )->update(
        [
            'questions' => htmlspecialchars($request->new_question),
        ]); 
        

         return redirect('/admin/discussions')->with('update_message', 'Your discussion topic has been updated!');
    }

    //fungsi delete question
    public function delete_question(Request $request)
    {
        $question_id = $request->question_id;
        $delete_this_question = Question::find($question_id);
        $delete_this_question->delete();

        return redirect('/admin/discussions')->with('delete_status', 'Your question has been deleted!');
    }

     //fungsi edit response
    public function edit_response(Request $request)
    {
        $id = $request->response_id;    
        $response = Response::find($id);

        return view('dashboard.admin.update_response', compact('response'));
    }

    //fungsi update response
    public function store_updated_response(Request $request)
    {
        Response::where('id', $request->response_id )->update(
        [
            'response' => htmlspecialchars($request->new_response),
        ]);
         
        return redirect('/admin/discussions')->with('update_message', 'Your response has been updated!');
    }

    //fungsi delete response
    public function delete_response(Request $request)
    {
        $response_id = $request->response_id;
        $delete_this_response = Response::find($response_id);
        $delete_this_response->delete();

        return redirect('/admin/discussions')->with('delete_status', 'Your response has been deleted!');
    }

    // fungsi create response
    public function create_responses(Request $request)
    {
        $response = new Response;
        $response->author_id = $request->author_id;
        $response->question_id = $request->question_id;
        $response->response= $request->new_response;
        $response->save();

        return redirect('/admin/discussions')->with('update_message','Your response has been uploaded to the forum! Thankyou for participating in this discussion.');
    }

    //mengembalikan ke halaman profile admin yang memiliki form update profile dan recent profile di sampingnya
    public function show_profile(){
        return view('dashboard.admin.profile');
    }

    //fungsi update profile admin
    public function update_profile(Request $request)
    {
        $user = User::find($request->user_id);
        User::where('id', $request->user_id)->update([
             'name' => htmlspecialchars($request->name),
             'email' => htmlspecialchars($request->email),
             'status' =>htmlspecialchars($request->status),
 
        ]);
        
         //memeriksa apakah inputan file gambar, nama, dan email
         $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|string|email|max:255',
        ]);
        
        if($request->hasFile('image')){
         $location = public_path('assets2/img');
         $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
         $user->image = $request->file('image')->getClientOriginalName();
         $user->save();
        }
        return redirect('/admin/dashboard')->with('status', 'Your profile has been updated!');
    }

    //fungsi untuk menampilkan halaman users list
    public function users_list(){
        return view('dashboard.admin.user_list');
    }

    //fungsi menghapus akun pengguna
    public function delete_user(Request $request){
        $user_id = $request->user_id;
        $this_user = User::find($user_id);
        $this_user->delete();

        return redirect('/admin/users_list')->with('delete_status', 'Your response has been deleted!');
    }

    //fungsi menghapus course
    public function delete_course(Request $request){
        $course_id = $request->course_id;
        $this_course = Course::find($course_id);
        $this_course->delete();

        return redirect('/admin/courses_list')->with('delete_status', 'A course has been deleted!');
    }

    // fungsi cari user
    public function cari_user(Request $request){
        $results = User::when($request->keyword_user, function ($query) use ($request) {
            $query  ->where('name', 'like', "%{$request->keyword_user}%")
                    ->orWhere('email', 'like', "%{$request->keyword_user}%");
        })->paginate(10);

        return view('dashboard.admin.user_list',compact('results'));
    }

    // fungsi cari course
    public function cari_course(Request $request){
        $results = Course::when($request->keyword_course, function ($query) use ($request) {
            $query  ->where('chapter_title', 'like', "%{$request->keyword_course}%")
                    ->orWhere('description', 'like', "%{$request->keyword_course}%")
                    ->orWhere('body', 'like', "%{$request->keyword_course}%");
        })->paginate(10);

        return view('dashboard.admin.courses_list',compact('results'));
    }

    // fungsi cari diskusi
    public function cari_questions(Request $request){
        $hasils = Question::when($request->keyword_question, function ($query) use ($request) {
            $query  ->where('topics', 'like', "%{$request->keyword_question}%");
        })->paginate(3);

        return view('dashboard.admin.discussions',compact('hasils'));
    }

    //fungsi menampilkan daftar kursus
    public function show_courses(){
        return view('dashboard.admin.courses_list');
    }

    //fungsi menampilkan halaman daftar events
    public function events(){
        return view('dashboard.admin.events');
    }

    //fungsi untuk menyimpan event baru
    public function create_events(Request $request){
        $event = new Event;
        $event->author_id = htmlspecialchars($request->author_id);
        $event->title= htmlspecialchars($request->title);
        $event->schedule = $request->schedule;
        $event->description = htmlspecialchars($request->description);

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            'title' => 'required|string|max:50|min:3',
            'description' => 'required|string|max:500',
            'schedule' => 'required',
        ]);

        if($request->hasFile('image')){
            $location = public_path('assets/img');
            $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
            $event->image = $request->file('image')->getClientOriginalName();
        }

        $event->save();

        return redirect('/admin/dashboard')->with('create_status','An event has been created. Your events will be displayed in main page, event section. Thankyou!');

    }

    //fungsi untuk mengedit event
    public function edit_events(Request $request)
    {
        $id = $request->event_id; 
        $event = Event::find($request->event_id);

        return view('dashboard.admin.edit_event',compact('event'));

    }

    //fungsi untuk menyimpan event yang sudah diedit
    public function store_edited_events(Request $request)
    {
        $event = Event::find($request->event_id);
        Event::where('id', $request->event_id)->update([
             'title' => htmlspecialchars($request->title),
             'description' => htmlspecialchars($request->description),
             'schedule' =>htmlspecialchars($request->schedule),
             'author_id'=>htmlspecialchars($request->author_id),
 
        ]);

         //memeriksa apakah inputan membawa file gambar
        if($request->hasFile('image')){
         $location = public_path('assets/img');
         $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
         $event->image = $request->file('image')->getClientOriginalName();
         $event->save();
        }
 
        return redirect('/admin/dashboard')->with('status', 'Your event has been updated!');
    }

    //fungsi untuk menghapus event
    public function delete_event(Request $request){
        $event_id = $request->event_id;
        $this_event = Event::find($event_id);
        $this_event -> delete();

        return redirect('/admin/dashboard')->with('delete_status', 'An event has been deleted!');
    }

    //fungsi untuk mengembalikan halaman create user
    public function create_user(){
        return view('dashboard.admin.create_user');
    }

    //fungsi untuk menyimpan data pengguna baru
    public function store_user(Request $request){
        $user = new User;
        $user->name= htmlspecialchars($request->name);
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = htmlspecialchars($request->status);

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string|max:30|min:3',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($request->hasFile('image')){
            $location = public_path('assets2/img');
            $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
            $user->image = $request->file('image')->getClientOriginalName();
        }

        $user->save();

        return redirect('/admin/dashboard')->with('status','An admin account has been added. Login to check up the account!');


    }

   
}
