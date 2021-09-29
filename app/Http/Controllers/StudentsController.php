<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Response;
use App\Models\Course;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $users = User::paginate(10);
        $events = Event::paginate(10);
        $questions = Question::paginate(10);
        $courses = Course::paginate(10);
        return view('dashboard.students.students_dashboard', compact('users','events','questions','courses'));
    }

    public function show_discussions(){
        $questions = Question::paginate(3);
        return view('dashboard.students.discussions', compact('questions'));
    }

    // fungsi untuk menyimpan data dari form question ke database
    public function create_discussions(Request $request)
    {
        $question = new Question;
        $question->author_id = $request->author_id;
        $question->questions= htmlspecialchars($request->new_question);
        $question->save();

        return redirect('/students/discussions')->with('status',"Your topics has been uploaded to the forum! Wait for a moment to see any response from another user.");

    }

    // fungsi edit question
    public function edit_question(Request $request)
    {
        $id = $request->question_id;    
        $question = Question::find($id);

       return view('dashboard.students.update_question', compact('question'));
    }

    //  fungsi store updated question
    public function store_updated_question(Request $request)
    {
        Question::where('id', $request->question_id )->update(
        [
            'questions' => htmlspecialchars($request->new_question),
        ]); 
         return redirect('/students/discussions')->with('status', 'Your discussion topic has been updated!');
    }

    //fungsi delete question
    public function delete_question(Request $request){
        $question_id = $request->question_id;
        $question = Question::find($question_id);
        $question->delete();

        return redirect('/students/discussions')->with('delete_status','Your question has been deleted!');
    }

    //fungsi edit response
    public function edit_response(Request $request)
    {
        $id = $request->response_id;    
        $response = Response::find($id);

        return view('dashboard.students.update_response', compact('response'));
    }

    //fungsi update response
    public function store_updated_response(Request $request)
    {
        Response::where('id', $request->response_id )->update(
        [
            'response' => htmlspecialchars($request->new_response),
        ]);
         
        return redirect('/students/discussions')->with('status', 'Your response has been updated!');
    }

    //fungsi delete response
    public function delete_response(Request $request)
    {
        $response_id = $request->response_id;
        $delete_this_response = Response::find($response_id);
        $delete_this_response->delete();

        return redirect('/students/discussions')->with('delete_status', 'Your response has been deleted!');
    }

    // fungsi create response
    public function create_responses(Request $request)
    {
        $response = new Response;
        $response->author_id = $request->author_id;
        $response->question_id = $request->question_id;
        $response->response= $request->new_response;
        $response->save();

        return redirect('/students/discussions')->with('status','Your response has been uploaded to the forum! Thankyou for participating in this discussion.');
    }

     //mengembalikan ke halaman profile trainers yang memiliki form update profile dan recent profile di sampingnya
     public function show_profile(){
        return view('dashboard.students.profile');
    }

     //fungsi update profile trainers
     public function update_profile(Request $request)
     {
         $student = User::find($request->user_id);
         User::where('id', $request->user_id)->update([
             'name' => htmlspecialchars($request->name),
             'email' => htmlspecialchars($request->email),
             'status' =>htmlspecialchars($request->status),
         ]);
          //memeriksa apakah inputan file gambar dengan format yang ditentukan
         $this->validate($request, [
                  'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
                  'name' => 'required|string|max:30|min:3',
                  'email' => 'required|string|email|max:255',
              ]);

        if($request->hasFile('image')){
         $location = public_path('assets2/img');
         $request-> file('image')->move($location, $request->file('image')->getClientOriginalName());
         $student->image = $request->file('image')->getClientOriginalName();
         $student->save();
        }
        return redirect('/students/dashboard')->with('status', 'Your profile has been updated!');
 
     }

    //fungsi untuk menampilkan halaman trainers list
    public function trainers_list(){
        return view('dashboard.students.trainers_list');
    }

    // fungsi cari user
    public function cari_course(Request $request){
        $results = Course::when($request->keyword_course, function ($query) use ($request) {
            $query  ->where('chapter_title', 'like', "%{$request->keyword_course}%")
                    ->orWhere('body', 'like', "%{$request->keyword_course}%")
                    ->orWhere('description', 'like', "%{$request->keyword_course}%");
        })->paginate(10);

        return view('dashboard.students.courses',compact('results'));
    }


    // fungsi cari user
    public function cari_user(Request $request){
        $results = User::when($request->keyword_user, function ($query) use ($request) {
            $query  ->where('name', 'like', "%{$request->keyword_user}%")
                    ->orWhere('email', 'like', "%{$request->keyword_user}%");
        })->paginate(10);

        return view('dashboard.students.trainers_list',compact('results'));
    }

    //fungsi menampilkan halaman kursus
    public function show_courses(){
        return view('dashboard.students.courses');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'=>['required','string','max:255'],
        ]);
    }
    
}
