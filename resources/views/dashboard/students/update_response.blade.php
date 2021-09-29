<?php 
$user_avatar = Auth::user()->image;
?>
@extends('dashboard.students.headerfooter')
@section('title')
<title>
    Trainers | Update Response
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
  <a class="nav-link" href="{{__('/students/profile')}}">
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
            <h6 class="card-category text-gray">Edit your response</h6>
            <p>
            Question : {{$response->questions->questions}} <br>
            <small><b>by {{$response->questions->user->name}}</b></small>
            </p>

            <!--FORM EDIT RESPONSE  -->
            <form action="{{route('students.store.updated.response')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Your recent response : </label>
                        <div class="form-group bmd-form-group">
                            <input type="number" name="response_id" value="{{$response->id}}" hidden>
                            <textarea class="form-control" rows="4" name="new_response" minlength="3" required> {{$response->response}} </textarea>
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