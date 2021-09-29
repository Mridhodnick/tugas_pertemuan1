<?php
$user_id = Auth::user()->user_id;
?>

@extends('dashboard.trainers.headerfooter')
@section('title')
<title>
    Trainers | Edit
  </title>
@endsection

@section('navbar')
<li class="nav-item">
  <a class="nav-link" href="{{__('/trainers/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{__('/trainers/discussions')}}">
    <i class="material-icons">bubble_chart</i>
    <p>Discussions</p>
  </a>
</li>
<li class="nav-item  active">
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">Edit this chapter</h4>
          </div>
          <div class="card-body">

          <!-- FORM EDIT LESSONS -->
            <form method="post" action="{{__('/trainers/update')}}">
            @csrf
              <input type="text" hidden name="course_id" value="{{$course->id}}">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="chapter_title">Chapter Title</label>
                    <input class="form-control" id="chapter_title" name="chapter_title" value="{{$course->chapter_title}}"  type="text" minlength="3" required autofocus>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label >Set your chapter brief description</label>
                    <div class="form-group">
                      <textarea class="form-control" name="description" rows="5" minlength="3" required>{{$course->description}}</textarea>
                    </div>
                  </div>
                </div>
              </div>        
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label >Edit your class lesson</label>
                    <div class="form-group">
                      <textarea class="form-control" name="body" rows="5" minlength="3" required>{{$course->body}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success pull-right">Save</button>
            <div class="clearfix"></div>
            </form>
            <!--AKHIR FORM CREATE -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


