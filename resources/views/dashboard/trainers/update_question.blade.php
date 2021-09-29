<?php 
$user_avatar = Auth::user()->image;
?>
@extends('dashboard.trainers.headerfooter')
@section('title')
<title>
    Trainers | Update Response
  </title>
@endsection

@section('navbar')
<li class="nav-item">
  <a class="nav-link" href="{{__('/trainers/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item active">
  <a class="nav-link" href="{{__('/trainers/discussions')}}">
    <i class="material-icons">bubble_chart</i>
    <p>Discussions</p>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link" href="{{__('/trainers/profile')}}">
    <i class="material-icons">person</i>
    <p>User Profile</p>
  </a>
  </li>
<li class="nav-item ">
  <a class="nav-link" href="{{__('/trainers/class_attendee')}}">
      <i class="material-icons">content_paste</i>
      <p>Class Attendee</p>
    </a>
</li>
<li class="nav-item ">
  <a class="nav-link" href="{{route('trainers_courses')}}">
    <i class="material-icons">library_books</i>
    <p>Courses</p>
  </a>
</li>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- UPDATE RESPONSE SECTION -->
      <div class="col-md-8">
        <div class="card card-profile">
          <div class="card-avatar">
            <a href="javascript:;">
              @if($user_avatar == NULL)
              <img class="img" src="../assets2/img/default-avatar.jpg">
              @else 
              <img class="img" src="../assets2/img/{{Auth::user()->image}}">
              @endif
            </a>
          </div>
          <div class="card-body">
            <h6 class="card-category text-gray">Edit your question</h6>
            <p>
            Question : {{$question->questions}} <br>
            <small><b>by {{$question->user->name}}</b></small>
            </p>

            <!--FORM EDIT RESPONSE  -->
            <form action="{{route('store_updated_question')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Your recent question : </label>
                        <div class="form-group bmd-form-group">
                            <input type="number" name="question_id" value="{{$question->id}}" hidden>
                            <textarea class="form-control" rows="4" name="new_question" minlength="3" required> {{$question->questions}} </textarea>
                            <button class="btn btn-warning btn-round" type="submit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- AKHIR FORM EDIT RESPONSE -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection