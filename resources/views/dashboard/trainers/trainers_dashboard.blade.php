<?php
  $user_avatar = Auth::user()->image;
?>
@extends('dashboard.trainers.headerfooter')
@section('title')
<title>
  Trainers | Dashboard
</title>
@endsection

@section('navbar')
<li class="nav-item active">
  <a class="nav-link" href="{{__('/trainers/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="{{__('/trainers/discussions')}}">
    <i class="material-icons">message</i>
    <p>Discussions</p>
  </a>
</li>
<li class="nav-item ">
  <a class="nav-link" href="{{__('/trainers/profile')}}">
    <i class="material-icons">person</i>
    <p>User Profile</p>
  </a>
</li>
<li class="nav-item">
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
<!-- CONTENT SECTION -->
<div class="content"> 
  <div class='container-fluid'>
    <div class="row">

      <!-- NOTIFICATION ALERT -->
      @if(session('status'))
      <div class="col-lg-15 col-md-4">
        <div class="card">
          <div class="card-header card-header-success">
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
      <div class="col-lg-15 col-md-4">
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
      <!-- END NOTIFICATION -->

      <!-- PROFILE SECTION -->
      <div class="col-md-12">
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
          <h6 class="card-category text-gray">{{Auth::user()->role}}</h6>
          <h4 class="card-title">{{Auth::user()->name}}</h4>
            @if(Auth::user()->status == NULL)
            <p class="card-description">
              Education is our passport to the future, for tomorrow belongs to the people who prepare for it today.<br>– Malcolm X 
            </p>
            @else
            <p class="card-description">
              {{Auth::user()->status}}
            </p>
            @endif
          <a href="{{__('/trainers/profile')}}" class="btn btn-success btn-round">Update</a>
        </div>
        </div>
      </div>
      <!-- END PROFILE SECTION -->

      <!-- INFORMATION SECTION -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">person</i>
            </div>
            <p class="card-category">Users</p>
            <h3 class="card-title">{{$users->total()}}
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">person</i>
              <a href="{{__('/trainers/class_attendee')}}">Observe</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">bubble_chart</i>
            </div>
            <p class="card-category">Events</p>
            <h3 class="card-title">{{$events->total()}}
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-danger">person</i>
              <a href="/events">Get  information in main page</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">book</i>
            </div>
            <p class="card-category">Courses</p>
            <h3 class="card-title">{{$courses->total()}}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">book</i> <a href="{{__('/trainers/courses')}}">observe all</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">message</i>
            </div>
            <p class="card-category">Discussions</p>
            <h3 class="card-title">{{$questions->total()}}</h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">local_offer</i> <a href="{{__('/trainers/discussions')}}">Observe</a>
            </div>
          </div>
        </div>
      </div>
      <!-- END INFORMATION SECTION -->
    </div>
  </div>
</div>
<!-- END CONTENT SECTION -->
@endsection
