<?php 
$user_avatar = Auth::user()->image;
?>
@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Update Response
  </title>
@endsection

@section('navbar')
<li class="nav-item">
  <a class="nav-link" href="{{__('/admin/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item active">
  <a class="nav-link" href="{{__('/admin/discussions')}}">
    <i class="material-icons">message</i>
    <p>Discussions</p>
  </a>
</li>
<li class="nav-item ">
<a class="nav-link" href="{{__('/admin/profile')}}">
  <i class="material-icons">person</i>
  <p>User Profile</p>
</a>
</li>
<li class="nav-item ">
<a class="nav-link" href="{{__('/admin/users_list')}}">
  <i class="material-icons">content_paste</i>
  <p>Users List</p>
</a>
</li>
<li class="nav-item ">
  <a class="nav-link" href="{{route('admin.courses')}}">
    <i class="material-icons">library_books</i>
    <p>Courses</p>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link" href="{{route('events')}}">
    <i class="material-icons">bubble_chart</i>
    <p>Events</p>
  </a>
</li>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
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

            <!--FITUR UPDATE RESPONSE  -->
            <form action="{{__('/admin/store_updated_question')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Your recent question : </label>
                        <div class="form-group bmd-form-group">
                            <input type="number" name="question_id" value="{{$question->id}}" hidden>
                            <textarea class="form-control" rows="4" name="new_question" minlength="3" required>{{$question->questions}}</textarea>
                            <button class="btn btn-warning btn-round" type="submit">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- AKHIR FITUR UPDATE RESPONSE -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection