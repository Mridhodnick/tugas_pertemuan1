<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 5Stars | English Learning Center</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>

<body class='w3-light-grey'>
<br><br><br>

<!-- HEADER -->
<nav class="w3-display-container w3-center w3-green w3-top" style="max-width:1500px">
    <h3 class="logo me-auto"><a href="{{__('/mainpage')}}" style="color:whitesmoke">5STARS</a></h3>
    <h6>Join to 5Stars to learn English for $FREE.99!</h6>
        @guest
            @if (Route::has('login'))
                <!-- <a class="w3-hover-light-grey w3-round w3-button" href="{{ route('login') }}">Login</a>            -->
            @endif
            @if (Route::has('register'))
                <!-- <a class="w3-hover-light-grey w3-round w3-button" href="{{ route('register') }}">Register</a> -->
            @endif
            @else
            <ul class="nav nav-tabs">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="/dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                Welcome {{ Auth::user()->name }}
                </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            </form>
                        </a>
                    </div>
                </li>
                </ul>
            @endguest
</nav>
<!-- AKHIR HEADER -->



<br><br><br><br><br>   

@yield('content')

<div class='w3-center'>
  <p>Make sure you insert the actual information. Get the best experience by joining 5Stars!</p>
  <br><br><br>
</div>
<!-- FOOTER -->
<footer class="footer">
        <div class="w3-center">
          <div class="copyright float-center">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script><strong><span> 5Stars</span></strong> Developer Team. All Rights Reserved
          </div>
        </div>
</footer>
<!-- FOOTER -->
<!-- Script sweet alert -->
<script src="bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="bower_components/sweetalert2/dist/sweetalert2.min.css">

<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
</body>
</html>