<?php
  $user_avatar = Auth::user()->image;
?>
@extends('dashboard.admin.headerfooter')
@section('title')
<title>
  Admin | Dashboard
</title>
@endsection

@section('navbar')
<li class="nav-item active">
  <a class="nav-link" href="{{__('/admin/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>
<li class="nav-item">
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
            ADMIN AUTHORITY: <br> 1. Admin could either update and delete their own profile <br> 2. Admin could only can read and delete user's account if they commit some violation against 5Stars rules <br>
            3. Admin only can read and delete courses for violation<br>4. Admin could participate in discussions. Admin also can delete questions and responses if they found it against the rules <br>
            5. Only admin can manage events 
            </p>
            @else
            <p class="card-description">
              {{Auth::user()->status}}
            </p>
            @endif
          <a href="{{__('/admin/profile')}}" class="btn btn-success btn-round">Update</a>
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
              <a href="{{__('/admin/users_list')}}">Observe</a>
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
              <i class="material-icons">book</i> <a href="{{__('/admin/courses_list')}}">observe all</a>
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
              <i class="material-icons">local_offer</i> <a href="{{__('/admin/discussions')}}">Observe</a>
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
