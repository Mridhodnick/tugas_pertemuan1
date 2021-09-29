<?php
use App\Models\Event;
$events = Event::paginate(10);
?>

@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Manage Events
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
            <!-- NOTIFICATION-->
            <!-- notifikasi delete event -->
            @if(session('delete_status'))
            <div class="col-lg-15 col-md-5">
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
            <!-- notifikasi update/create event -->
            @if(session('create_status'))
            <div class="col-lg-15 col-md-5">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Notification Alert</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <p>
                            {{ session('create_status') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
            <!-- END NOTIFICARION SECTION -->

            <!-- Fitur read daftar event-->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">All events</h4>
                        <p class="card-category">You can either delete and update them</p>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        <thead class=" text-primary">
                            <th>No</th>
                            <th>Title</th>              
                            <th>Schedule</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                        </thead>
                        <tbody>
                        <?php $i =1 ;?>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$event -> title}}</td>
                                <td>{{$event -> schedule}}</td>
                                <td>{{$event -> description}}</td>
                                <td>{{$event -> image}}</td>
                                <td>
                                    <!-- FITUR EDIT EVENT -->
                                    <form action="{{route('edit.event')}}" method="post">
                                    @csrf
                                    <input type="number" value="{{$event->id}}" hidden name="event_id">
                                    <input type="number" value="{{Auth::user()->id}}" hidden name="author_id">
                                    <button type="submit" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    </form>
                                    <!-- AKHIR FITUR EDIT EVENT -->
                                </td>
                                <td>
                                    <!-- FITUR DELETE EVENT -->
                                    <form action="{{route('delete.event')}}" method="post">
                                    @csrf
                                    <input type="number" name="event_id" value="{{$event->id}}" hidden>
                                    <button type="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">
                                        <i class="material-icons">close</i>
                                    </button>
                                    </form>
                                    <!-- AKHIR FITUR DELETE EVENT -->
                                <?php $i++; ?>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>

                    <!--PAGINATION SECTION-->
                    <nav aria-label="...">
                        <ul class="pagination">
                        <li class="page-item">{{$events->links("pagination::bootstrap-4")}}</li>
                        </ul>
                    </nav>
                    </div>
                    <!-- END PAGINATION SECTION -->

                    </div>
                </div>
            </div>

            <!-- FITUR CREATE EVENT BARU -->
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Create new event</h4>
                    </div>
                    <div class="card-body table-responsive">
                    <form method="post" action="{{route('create.events')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="number" hidden name="author_id" value="{{Auth::user()->id}}">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Schedule</label>
                                <input type="date" name="schedule" class="form-control @error('schedule') is-invalid @enderror" value="{{ old('schedule') }}" >
                                @error('schedule')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Description</label>
                                <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" >{{ old('description') }}</textarea>
                                @error('description')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            </div>
                        </div>
                            <label for="image" class="bmd-label-floating">Choose relevant image (jpg,jpeg,png,gif)</label>
                            <br>
                            <input type="file" name="image">
                            @error('image')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <br><br>
                            <button type="submit" class="btn btn-warning pull-right">Save</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- AKHIR FITUR CREATE EVENT -->
        </div>
    </div>
</div>
@endsection