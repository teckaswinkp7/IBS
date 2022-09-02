@extends('front/header')  
@section('content') 
<div class="site-section">
<div class="container">
<div class="row justify-content-center"> 
@include('front/leftsidebar')   
<div class="col-md-9">
<div class="card custom-margin">
<div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <h4>Your Profile</h4>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form>
        <h5>Personal Details</h5>
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
          <p>{{ ucwords(Auth::user()->name) }}</p>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-4 col-form-label">Email*</label> 
          <div class="col-8">
          <p>{{ Auth::user()->email}}</p>
          </div>
        </div>
        <div class="form-group row">
          <label for="newpass" class="col-4 col-form-label">Phone</label> 
          <div class="col-8">
          <p>{{ Auth::user()->phone }}</p>
          </div>
        </div> 
        <h5>Educational Details</h5>
        <table class="table table-bordered">
          <thead>
          <tr>
          <th>Qualification</th>
          <th>Board</th>
          <th>Percentage</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($student_edu as $cat)
          <tr>
          <td>{{ $cat->qualification }}</td>
          <td>{{ $cat->board }}</td>
          <td>{{ $cat->percentage }}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <div class="row">
    <h5>Course Details</h5>
    <div class="col-md-12">
      <form action="{{ route('student.course') }}" method="POST">
       @csrf  
        <input type="hidden" value="{{ Auth::user()->id }}" name="stu_id" class="form-control"  readonly>
        <div class="form-group row">
          <label for="username" class="col-4 col-form-label">Name*</label> 
          <div class="col-8">
            <select name="student_course_id" id="student_course_id" class="form-control">
              @foreach ($course_final_select as $key => $cselect)
              <option value="{{$course_sel[$key]}}">{{$cselect[0]}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>  
    </div>  
   
  </div> 
</div>
</div>
</div>
</div>
</div>
</div>
@include('front/footer')  
@endsection
</body>
</html>   