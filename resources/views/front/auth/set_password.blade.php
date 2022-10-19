@extends('front/header')  
@section('content') 
<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image:url({{asset('assets/front/images/bg_1.jpg')}});">
  <div class="container">
    <div class="row align-items-end justify-content-center text-center">
      <div class="col-lg-7">
        <h2 class="mb-0">Register</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
      </div>
    </div>
  </div>
</div> 
<div class="custom-breadcrumns border-bottom">
  <div class="container">
    <a href="{{ URL::to('/') }}">Home</a>
    <i class="mx-3 mt-2 fa-solid fa-angle-right" style="font-size:12px;"></i>
    <span class="current">Set Your Password</span>
  </div>
</div>
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
   
    <div class="col-md-5">
      <form action="{{route('register.final')}}" method="POST">
      @csrf     
      
      <div class="col-md-12 form-group">
        <label for="email">I am a<span style="color:red !important;font-weight:700;">*</span></label>
        <select id="user_role" class="form-control form-control-lg" name="user_role">
          <option value="2">Student</option>
          <option value="3">Sponsor</option>
        </select>        
      </div>

      <div class="col-md-12 form-group">
      <label for="password">Password<span style="color:red !important;font-weight:700;">*</span></label>
        <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
      </div>
      <div class="col-md-12 form-group">
      <label for="Confirm_password">Confirm Password<span style="color:red !important;font-weight:700;">*</span></label>
        <input type="password" id="password" class="form-control form-control-lg" name="confirm_password" placeholder="Confirm Password" required>
      </div>
      @if ($errors->has('password'))
       <div class="input-group mb-3"> <span class="text-danger">{{ $errors->first('password') }}</span></div>
      @endif
      <div class="row">
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary">
          Register
          </button>
        </div>
      </div>
      </form>
      <p class="mb-0">
        <a href="{{ route('login') }}" class="text-center">Already Regsitered</a>
      </p>
    </div>
    </div>  
  </div>
</div>
@include('front/footer')  
@endsection   