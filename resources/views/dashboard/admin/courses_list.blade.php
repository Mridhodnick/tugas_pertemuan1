<?php
use App\Models\Course;
$user_avatar = Auth::user()->image;
$courses = Course::paginate(10);
?>

@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Courses
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
<li class="nav-item ">
<a class="nav-link" href="{{__('/admin/users_list')}}">
  <i class="material-icons">content_paste</i>
  <p>Users List</p>
</a>
</li>
<li class="nav-item active">
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

@section('fitur_cari')
 <!--FITUR CARI  -->
 <form class="navbar-form" action="{{route('admin.cari.course')}}">
  <div class="input-group no-border">
    <input type="text" name="keyword_course" class="form-control" placeholder="search course...">
    <button type="submit" class="btn btn-white btn-round btn-just-icon">
      <i class="material-icons">search</i>
    </button>
  </div>
</form>
<!-- AKHIR FORM PENCARIAN -->
@endsection

@section('content')
<!-- CONTENT SECTION -->

<div class="content">
  <div class="container-fluid">
    <div class="row">
    
      <!--MENAMPILKAN HASIL PENCARIAN-->
      @if(isset($results))
        <div class="col-lg-15 col-md-8">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Search results</h4>
            </div>
            <div class="card-body table-responsive">
              <div class="col-lg-10 col-md-6 col-sm-6">
                @foreach($results as $result)
                  <div class="card card-stats">
                    <div class="card-header card-header-primary card-header-icon">
                      <h4>Search Results</h4>
                      <div class="card-icon">
                      <i class="material-icons">library_books</i>
                      </div>
                      <p class="card-category">{{$result->chapter_title}}</p>
                      <h3 class="card-title">Up: {{$result->created_at->format('l, d F Y')}}</h3>
                    </div>
                    <div class="card-footer">
                      <div class="stats">
                        <i class="material-icons">date_range</i> 
                        <p>{{$result->body}}</p><br>
                      </div>
                    </div>
                    <!-- fitur delete course -->
                    <form action="{{route('admin.delete.course')}}" method="post" class="d-inline">
                    @csrf
                          <input type="number" name="course_id" value="{{$result->id}}" hidden>
                          <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">Delete</button>
                    </form>
                    <!-- akhir fitur delete -->
                  </div>
                @endforeach
                <p><small>Course that match : {{$results->total()}}</small></p>
                </div>
            </div>
          </div>
        </div>
      @endif
      <!-- AKHIR HASIL PENCARIAN -->

      <!-- notifikasi delete courses -->
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
      <!-- akhir notifikasi -->


      <!-- READ COURSES -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">All uploaded chapter are below</h4>
            <p class="card-category">You can only delete them if the course violate the rules and terms.</p>
          </div>
          <div class="card-body">
          <div class="col-lg-10 col-md-12">

          <?php $i=0?>
            @foreach ($courses as $course)
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title">Title : {{$course->chapter_title}}</h4>
                  <p><small> Description: <br> {{$course->description}}</small></p>
                </div>
                <div class="card-body table-responsive">
                  <p>Content: <br>{{$course->body}}</p>

                  <!-- form delete courses -->
                  <form action="{{route('admin.delete.course')}}" method="post" class="d-inline">
                  @csrf
                  <input type="number" name="course_id" value="{{$course->id}}" hidden>     
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">Delete</button>
                  </form>
                  <!-- akhir form -->

                </div>
              </div>  
              <?php $i++?> 
            @endforeach
          </div>

          <!-- PAGINATION SECTION -->
          <div class="box-footer">
            <div class="pull-left">
              <small> Uploaded courses lessons in sum: {{$courses->total()}}</small>
            </div>
            <div class="pull-right">
            <!--fitur pagination -->
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item">{{$courses->links("pagination::bootstrap-4")}}</li>
              </ul>
            </nav>
            </div>
            <!-- akhir fitur pagination --> 
          </div>
          <!-- END PAGINATION SECTION -->
          </div>
        </div>
      </div>

      <!-- PROFILE SECTION -->
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
      <!-- END PROFILE SECTION -->
    </div>
  </div>
</div>
<!-- END CONTENT SECTION -->


@endsection
