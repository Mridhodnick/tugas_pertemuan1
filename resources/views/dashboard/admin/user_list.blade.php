<?php
use App\Models\User;
$users = User::paginate(10);
?>

@extends('dashboard.admin.headerfooter')
@section('title')
<title>
    Admin | Users List
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

<li class="nav-item active">
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

@section('fitur_cari')
<!--FITUR CARI  -->
<form class="navbar-form" action="{{route('admin.cari.user')}}">
  <div class="input-group no-border">
    <input type="text" name="keyword_user" class="form-control" placeholder="Find users contact...">
    <button type="submit" class="btn btn-white btn-round btn-just-icon">
      <i class="material-icons">search</i>
    </button>
  </div>
</form>
<!-- AKHIR FITUR CARI -->
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- NOTIFICATION SECTION -->
      @if(session('delete_status'))
      <div class="col-lg-15 col-md-10">
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
      <!-- END NOTIFICATION SECTION -->


      <!-- HASIL PENCARIAN -->
      @if(isset($results))
      <div class="col-lg-15 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Search results</h4>
          </div>
          <div class="card-body table-responsive">
            <div class="col-lg-7 col-md-4 col-sm-4">
              @foreach($results as $result)
                <div class="card card-stats">
                  <div class="card-header card-header-danger card-header-icon">
                    <h4>Search Results</h4>
                    <div class="card-icon">
                      <i class="material-icons">person</i>
                    </div>
                    <p class="card-category">{{$result->name}} | {{$result->role}}</p>
                    <h3 class="card-title">contact: {{$result->email}}</h3>
                  </div>
                  <div class="card-footer">
                    <div class="stats">
                      <i class="material-icons">date_range</i> 
                      <p>{{$result->status}}</p>
                    </div>
                  </div>
                </div>
              @endforeach
              <small>User that match : {{$results->total()}}</small>
            </div>
          </div>
        </div>
      </div>
      @endif
      <!-- AKHIR HASIL PENCARIAN -->

    
      <!--FITUR READ -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Here's all the users list in 5Stars</h4>
            <p class="card-category">You only can delete any account if the user proved violate 5Stars rules. You also can contact them via email.</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>No</th>
                  <th>Name</th>              
                  <th>Email</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Action</th>
                </thead>
                <tbody>
                <?php $i =1 ;?>
                @foreach ($users as $user)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$user -> name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->role}}</td>
                    <td>
                    <form action="{{route('delete.user')}}" method="post">
                      @csrf
                      <input type="number" name="user_id" value="{{$user->id}}" hidden>
                      <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure? You cannot undo this step. Please do this action carefully!')">Delete</button>
                    </form>
                    <?php $i++; ?>
                    </td>
                  </tr>   
                @endforeach
                </tbody>
              </table>
            </div>
            <br><br>

            <a class="btn btn-success" href="{{__('/admin/add_user')}}">Add another admin account</a>

            <br><br><br>

            <!--PAGINATION SECTION -->
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item">{{$users->links("pagination::bootstrap-4")}}</li>
              </ul>
            </nav>
            </div>
            <!-- END PAGINATION SECTION -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection