@extends('layouts.headerfooter')

@section('title')
<title>5Stars | Events </title>
@endsection

@section('navbar')
  <li><a href="{{__('/mainpage')}}">Home</a></li>
  <li><a href="{{__('/about')}}">About</a></li>
  <li><a class="active" href="#">Events</a></li>
@endsection  

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>Events</h2>
        <p>Every events will be informed more details if you join 5Stars as a student or trainer. Join right now!</p>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container" data-aos="fade-up">
        <div class="row">

          @foreach($events as $event)
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="card">
              <div class="card-img">
                <img src="../assets/img/{{$event->image}}" >
              </div>
              <div class="card-body">
                <h5 class="card-title"><a href="">{{$event->title}}</a></h5>
                <p class="fst-italic text-center">{{$event->schedule}}</p>
                <p class="card-text">{{$event->description}}</p>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Events Section -->

  </main><!-- End #main -->

@endsection