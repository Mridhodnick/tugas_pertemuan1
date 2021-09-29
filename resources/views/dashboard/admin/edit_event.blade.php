<?php
$user_id = Auth::user()->user_id;
?>

@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Edit Event
  </title>
@endsection

@section('navbar')
<li class="nav-item">
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

<li class="nav-item">
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
<li class="nav-item active">
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">Edit this event</h4>
          </div>
          <div class="card-body">
            <!-- Form edit events -->
            <form method="post" action="{{route('save.edited.events')}}" enctype="multipart/form-data">
            @csrf
            <input type="number" hidden name="author_id" value="{{Auth::user()->id}}">
            <input type="numer" hidden name="event_id" value="{{$event->id}}">
                <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" name="title" class="form-control" value="{{$event->title}}" required>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Schedule</label>
                                <input type="date" name="schedule" class="form-control" value="{{$event->schedule}}" required>
                                
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Description</label>
                                <textarea name="description" rows="3" class="form-control" required>{{$event->description}}</textarea>
                            </div>
                            </div>
                        </div>
                            <label for="image" class="bmd-label-floating" >Choose relevant image (jpg,jpeg,png,gif)</label>
                            <br>
                            <input type="file" name="image" accept="image/gif,image/jpeg,image/jpg,image/png,">
              <br><br>
              <button type="submit" class="btn btn-warning pull-right">Update Event</button>
              <div class="clearfix"></div>
            </form>
            <!-- Akhir form edit events -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


