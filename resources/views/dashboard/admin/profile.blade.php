<?php 
$user_avatar = Auth::user()->image;
?>
@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Update Profile
  </title>
@endsection

@section('navbar')
<li class="nav-item ">
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
<li class="nav-item active">
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
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Make your profile up to date</h4>
            <p class="card-category">Complete your profile</p>
          </div>
          <div class="card-body">
            <!-- FITUR UPDATE PROFILE -->
            <form method="post" action="{{route('admin_update_profile')}}" enctype="multipart/form-data">
            @csrf
            <input type="number" hidden name="user_id" value="{{Auth::user()->id}}">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control  @error('name') is-invalid @enderror" pattern="[a-zA-Z\s]+" autocomplete="name">
                    @error('name')
                      <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" name="email" value="{{Auth::user()->email}}"class="form-control  @error('email') is-invalid @enderror" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" autocomplete="email">
                      @error('email')
                      <span style="color:red">{{ $message }}</span>
                      @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Status</label>
                    <input type="text" name="status" value="{{Auth::user()->status}}" class="form-control">
                  </div>
                </div>
              </div>
              <label for="image" class="bmd-label-floating">Change your avatar (jpg,jpeg,png)</label>
              <br>
              <input type="file" name="image">
              @if ($errors->has('image'))
                  <div style="color:red">No file uploaded</div>
                  @endif
              <br><br>
              <button type="submit" class="btn btn-warning pull-right">Update Profile</button>
              <div class="clearfix"></div>
            </form>
            <!-- END FITUR UPDATE -->
          </div>
        </div>
      </div>

      <!-- PROFILE SECTION -->
      <div class="col-md-4">
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
            <h6 class="card-category text-gray">ADMIN</h6>
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
            <a href="{{__('/admin/profile')}}" class="btn btn-success btn-round">Update</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection