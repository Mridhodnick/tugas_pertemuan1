<?php 
use App\Models\User;
$trainers = User::where('role','trainers')->paginate(10);

?>

@extends('dashboard.students.headerfooter')
@section('title')
<title>
    Students | Trainers List
  </title>
@endsection

@section('navbar')
<li class="nav-item">
  <a class="nav-link" href="{{__('/students/dashboard')}}">
    <i class="material-icons">dashboard</i>
    <p>Dashboard</p>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="{{__('/students/discussions')}}">
    <i class="material-icons">message</i>
    <p>Discussions</p>
  </a>
</li>

<li class="nav-item">
<a class="nav-link" href="{{('/students/profile')}}">
  <i class="material-icons">person</i>
  <p>User Profile</p>
</a>
</li>

<li class="nav-item active">
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

@section('fitur_cari')
 <!--FITUR CARI  -->
 <form class="navbar-form" action="{{route('students.cari.user')}}">
  <div class="input-group no-border">
    <input type="text" name="keyword_user" class="form-control" placeholder="Find trainers contact...">
    <button type="submit" class="btn btn-white btn-round btn-just-icon">
      <i class="material-icons">search</i>
    </button>
  </div>
</form>
<!-- AKHIR FORM PENCARIAN -->
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">

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


    
      <!-- Fitur read daftar trainers -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Here's all the trainers list in 5Stars</h4>
            <p class="card-category">You can contact them for any importance</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>No</th>
                  <th>Name</th>              
                  <th>Email</th>
                  <th>Status</th>
                </thead>
                <tbody>
                <?php $i =1 ;?>
                @foreach ($trainers as $trainer)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$trainer -> name}}</td>
                    <td>{{$trainer->email}}</td>
                    <td>{{$trainer->role}}</td>
                    <?php $i++; ?>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>

            <!--fitur pagination -->
            <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item">{{$trainers->links("pagination::bootstrap-4")}}</li>
              </ul>
            </nav>
            </div>
            <!-- akhir fitur pagination -->

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection