@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/emp-login.css')}}">

  @if(session('error'))
  <div class="alert">
    <p class="error-msg"> {{session('error')}}</p>  
    <p class="closebtn" onclick="this.parentElement.style.display='none';">&times;</>
  </div>    
  @endif

<div id="content" style="max-height:400px;">
  <div class="bg-img">
  <form method="post" action="{{route('auth.check') }}" class="formdiv">
    @csrf

    <br><br><br>
      <p class="caption"> Employee Login </p> <br>    
       <div class="form-group">
        <span class="fa fa-user-circle-o form-control-icon text-warning"></span>
        <input type="text" name="id" class="form-control input-field" value="{{ old('id')}}" placeholder="Enter ID" tabindex="10" required>
      </div>
      <div class="form-group">
        <span class="fa fa-key form-control-icon text-warning"></span>
        <input type="password" class="form-control input-field" name="password" id="login-pass" placeholder="Password" tabindex="10" required>
        <span class="input-group-btn" id="eyeSlash" style="position:relative;float:right;margin-left: -25px;margin-top: -45px;z-index: 2;">
          <button class="btn btn-default reveal" onclick="Show()" type="button"><i class="fa fa-eye-slash" aria-hidden="true" style="color:#f7ca02;"></i></button>
        </span>
        <span class="input-group-btn" id="eyeShow" style="display: none;position:relative;float:right;margin-left: -25px;margin-top: -45px;z-index: 2;">
          <button class="btn btn-default reveal" onclick="Show()" type="button"><i class="fa fa-eye" aria-hidden="true" style="color:#f7ca02;"></i></button>
        </span>
        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
      </div>
      <div class="form-group" style="text-align: center;">
        <button type="submit" class="btn-login">
            <i class="fa fa-sign-in icon" style="color:#3B3131;"> </i>
            Login
        </button>  
        <button type="submit" class="btn-cancel">
             <i class="fa fa-times icon" style="color:red;"> </i>
             Cancel
        </button>
      </div>
  </form>
  </div>
</div>

@endsection
<script src="{{asset('js/login.js')}}"></script>