<?php 
$user_avatar = Auth::user()->image;
?>
@extends('dashboard.students.headerfooter')
@section('title')
<title>
  Students | Discussions
</title>
@endsection

@section('navbar')
<li class="nav-item">
  <a class="nav-link" href="{{__('/students/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>

<li class="nav-item active">
  <a class="nav-link" href="{{__('/students/discussions')}}">
    <i class="material-icons">message</i>
    <p>Discussions</p>
  </a>
</li>

<li class="nav-item ">
<a class="nav-link" href="{{('/students/profile')}}">
  <i class="material-icons">person</i>
  <p>User Profile</p>
</a>
</li>

<li class="nav-item ">
<a class="nav-link" href="{{__('/students/trainers_list')}}">
  <i class="material-icons">content_paste</i>
  <p>Trainers List</p>
</a>
</li>

<li class="nav-item ">
  <a class="nav-link" href="{{__('/students/courses')}}">
    <i class="material-icons">library_books</i>
    <p>Courses</p>
  </a>
</li>
@endsection

@section('content')
<!-- CONTENT SECTION -->
<div class="content">
  <div class="container-fluid">
    <div class="row">

    <!-- notification section -->
    @if(session('status'))
    <div class="col-lg-6 col-md-10">
      <div class="card">
        <div class="card-header card-header-warning">
          <h4 class="card-title">Notification Alert</h4>
        </div>
        <div class="card-body table-responsive">
          <p>
              {{ session('status') }}
          </p>
        </div>
      </div>
    </div>
    @endif
    @if(session('delete_status'))
    <div class="col-lg-6 col-md-10">
      <div class="card">
        <div class="card-header card-header-danger">
          <h4 class="card-title">Notification Alert</h4>
        </div>
        <div class="card-body table-responsive">
          <p>
              {{ session('delete_status') }}
          </p>
        </div>
      </div>
    </div>
    @endif
    <!-- akhir notification -->

    <!-- DISCUSSIONS SECTION -->
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-info">
          <h4 class="card-title">All uploaded questions are below</h4>
          <p class="card-category">You can either edit or delete them</p>
        </div>
        <div class="card-body">
          <div class="col-lg-10 col-md-12">
            @foreach ($questions as $question)
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{$question->user->name}} | {{$question->user->role}}</h4>
                <p><b>Question : </b></p>
                <p>{{$question->questions}}</p>

                <!--fitur update dan delete jika author_id pertanyaan sesuai dengan id -->
                @if(Auth::user()->id == $question->user->id)
                  <!-- fitur update question-->
                  <form action="{{route('students_edit_question')}}" method="post" class="d-inline">
                    @csrf 
                    <input type="number" name="question_id" value="{{$question->id}}" hidden>
                    <button class="btn btn-primary pull-right" type="submit"> Edit </button>
                  </form>

                  <!-- fitur delete question -->
                  <form action="{{route('students_delete_question')}}" class="d-inline" >
                    @csrf
                    <input type="number" name="question_id" value="{{$question->id}}" hidden>     
                    <button class="btn  btn-danger pull-right" type="submit" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">Delete</button>
                  </form>
                  <!--akhir fitur update delete question-->
                @endif
                
                <!--akhir fitur update delete question-->
              </div>
              <div class="card-body table-responsive">
                <!-- fitur read response -->
                <p><i>All responses to this question are below: </i></p><hr>
                @foreach($question->responses as $response)
                  <p>{{$response->response}}</p>
                  <p><b>{{$response->user->name}} | {{$response->user->role}}</b></p>

                  <!-- fitur update delete jika author_id sesuai dengan id user -->
                  @if(Auth::user()->id == $response->user->id)
                    <!-- fitur update response-->
                    <form action="{{route('students_update_response')}}" method="post" class="d-inline">
                      @csrf 
                      <input type="number" name="response_id" value="{{$response->id}}" hidden >
                      <button class="btn btn-warning" type="submit"> Edit </button>
                    </form>
                    <!-- form delete response -->
                    <form action="{{route('students_delete_response')}}" method="post" class="d-inline">
                      @csrf
                      <input type="number" name="response_id" value="{{$response->id}}" hidden>     
                      <button class="btn  btn-danger" type="submit" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">Delete</button>
                    </form>
                    <!-- akhir fitur update delete-->
                  @endif
                  <hr>
                @endforeach

                <!-- fitur create response-->
                <form action="{{route('students_response')}}" method="post">
                  @csrf 
                  <input type="number" name="author_id" value="{{Auth::user()->id}}" hidden>
                  <input type="number" name="question_id" value="{{$question->id}}" hidden>
                  <textarea name="new_response" rows="3" class="form-control" placeholder="What is your opinon about this topic? Just simply mentioned other respondent if you need." minlength="3" required></textarea>
                  <button class="btn btn-success pull-right" type="submit">Response</button>
                </form>
                <!-- akhir fitur create response -->

              </div>
            </div>  
            @endforeach
          </div>

          <!--fitur pagination -->
          <nav aria-label="...">
            <ul class="pagination">
              <li class="page-item">{{$questions->links("pagination::bootstrap-4")}}</li>
            </ul>
          </nav>
          <!-- akhir fitur pagination -->
        </div>
      </div>
    </div>

    <!--  profile section -->
    <div class="col-md-4">
      <div class="card card-profile">
        <div class="card-avatar">
        <a href="javascript:;">
        @if($user_avatar == NULL)
          <img class="img" src="{{asset('../assets2/img/default-avatar.jpg')}}">
        @else
          <img class="img" src="../assets2/img/{{Auth::user()->image}}">
        @endif
        </a>
        </div>
        <div class="card-body">
          <h6 class="card-category text-gray">{{Auth::user()->role}}</h6>
          <h4 class="card-title">{{Auth::user()->name}}</h4>

          <p>Create a new discussion topic.</p>
          <!-- fitur create new question -->
          <form action="{{route('students_ask')}}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Your question :  </label>
                  <div class="form-group bmd-form-group">
                    <input type="number" name="author_id" value="{{Auth::user()->id}}" hidden >
                    <textarea class="form-control" rows="4" name="new_question" minlength="3" minlength="3" required></textarea>
                    <button class="btn btn-success " type="submit" >Discuss in forum</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!-- akhir fitur create new discussion-->
        </div>
      </div>
    </div>
    <!-- akhir profile section -->
  </div>
</div>

<!-- END CONTENT SECTION -->
@endsection
      