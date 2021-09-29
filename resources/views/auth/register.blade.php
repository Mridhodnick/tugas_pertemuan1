@extends('layouts.app')

@section('content')
<!-- FORMULIR DAFTAR -->
<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-white" style="max-width:600px">
    <div class="w3-center"><br>
        <img src="https://th.bing.com/th/id/R207b76b34cb30badfa528fa9d7f79138?rik=WhvQzbGDrYL4Cg&riu=http%3a%2f%2fi.huffpost.com%2fgen%2f1801406%2fimages%2fo-STUDENT-ON-COMPUTER-facebook.jpg&ehk=fkh1ftsgKUtwpFkhIeDnkQXVYb5hSZD4k2MVQoNtcqA%3d&risl=&pid=ImgRaw" style="width:30%;" class="w3-circle w3-margin-top">
        <h4><b>Sign Up Menu</b></h4><br>
        <h5><b>-Student-</b></h5>
    </div>
    <div class="w3-section w3-container">
      <form  method="POST" action="{{ route('register') }}" entype="multipart/form-data">
      @csrf 
        <!-- Students yang mendaftar otomatis terdaftar dengan level 3-->
        <input type="string" id="role" name="role" value="students" hidden>
    <div class="form-group">
        <label><b>{{ __('Name') }}</b></label>
        <input class="w3-input w3-margin-bottom" pattern="[a-zA-Z\s]+" placeholder="Enter a valid name only with abjad and white spaces" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
            @error('name')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
        <label><b>{{ __('E-Mail Address') }}</b></label>
        <input class="w3-input w3-margin-bottom" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  placeholder="example@email.com" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <span class="alert alert-danger">{{ $message }}</span>
            @enderror
    </div>
    <div class="form-group">
        <label><b>{{ __('Password') }}</b></label>
        <input class="w3-input w3-margin-bottom" placeholder="Enter your password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
            @error('password')
                <span class="alert alert-danger" >{{ $message }}</span>
            @enderror
    </div>        
        <label><b>{{ __('Confirm Password') }}</b></label>
        <input class="w3-input w3-margin-bottom" id="password-confirm" placeholder="Confirm your password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password">
            @error('password_confirmation')
                <span class="alert alert-danger" >{{ $message }}</span>
            @enderror
        <button class="w3-button w3-block w3-round w3-green w3-section w3-padding" name type="submit"> {{ __('Sign Up') }}</button>
      </form> 
      <a href="/register_as_trainer" class='w3-text-blue w3-center'>Sign up as a Trainer</a>
      <div class="w3-right">
      <p>Already have an account? <a class="w3-text-blue" href="/login">Login</a></p> 
      </div>
      <br><br><br>
    </div>
</div>
@endsection
<!-- AKHIR FORMULIR DAFTAR AKUN -->
