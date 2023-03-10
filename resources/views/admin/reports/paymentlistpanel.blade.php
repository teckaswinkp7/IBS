@extends('admin.header')  
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          
            
            <h3 class="card-title">Payment List Panel</h3>
          
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <form action="{{route('search.index')}}" method="GET">
            <input type="search" placeholder="search"> </input> <button class="searchbtn"> <i class="fa-solid fa-magnifying-glass"></i></button>
</form>   
        </ol>
           
          </div>
          <div class="col-sm-12" style="margin-top:30px;">
          <h1><a class="btn btn-success float-right colorbtn" href="{{ route('courses.create') }}"> Export Order</a></h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-4">

</div>
         
              <!-- /.card-header -->
              
              <table class="table col-md-8 tableheight ">
    <tr style="border-top:none;" >
    
        <form action="" method="get">

          <th > </th>
    <th style="vertical-align:bottom;"> <label for="date"> Date: </label> <input type='date' name="date"  class="datepicker form-control" placeholder="Date" ></input> </th>
         
         <th style="vertical-align:bottom;"> <button class="btn btn-primary btnreview" value="filter" type="submit" name="paybutton" style=" padding: 5px 15px; background-color: #cc6600; border-color:#cc6600; color: white; margin-top:30px; margin-left:5px; margin-right:5px;"> Apply </button> </th>
</form>   
<form action="">
        <th style="vertical-align:bottom;"><label> Search: </label> <div class="input-group">
      <input  placeholder="search here" class="form-control py-1" type="search" name="search" value="" id="example-search-input">
      <span class="input-group-append">
        <button class="btn btn-outline-secondary btnreview" type="submit" style="background-color: #cc6600; color:white;">
            <i class="fa fa-search" ></i>
        </button>
      </span>
</div>

</form>     




</tr>
</table>

                <table class="table table-striped">
    <thead>
        <tr>
            {{$paymentcount}} Applicants Found.
</tr>
    <tr>
      <th>ID</th>
      <th >Name</th>
      <th >Course</th>
      <th> Date Submitted</th>
      <th> Total Amount </th>
      <th >Amount due</th>
      <th>Invoice </th>
      <th >Sync Invoice</th>
      
    </tr>
  </thead>
  <?php $_SESSION['i'] = 0; ?>   
  @foreach ($paymentlist as $user)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
  <tbody>
  <form action="" method="post" enctype="multipart/form-data">
        @csrf  
      <td>{{$_SESSION['i']}}</td>
      <td>{{ $user->name }} </td>
      <td>{{$user->coursename}}</td>
      <td>{{$user->updated_at->format('d/m/y')}}</td>
      <td> {{$user->amountdue}}</td>
     <td>{{$user->balance_due}} </td>
      <td><a href="{{url('/pdf')}}/{{$user->invoice}}" target=_blank><button class="btn btn-primary btnreview"><i class="fa-regular fa-eye backgroundclass"> </i></a></button> </td>
      <td><a href=""><button class="btn btn-primary btnreview" id="desktop">sync</a></button></td>
      
      @endforeach
      <?php unset($_SESSION['i']); ?>    
</tbody>

        <tfoot>

</tfoot>
   
</table>
<div class="ml-auto">

</div>

     
              
              <!-- /.card-body -->
           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @include('admin.footer') 
  @endsection
</body>
<style>
    .bacgroundclass{
        background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
        padding:30px;
    border-radius: 50%;
  
    }
.btnreview{

  background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
  border:none!important;
}
.colorbtn{
    background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 
    border:none!important;
}
.cardcolor{


background:#dee2e6;
margin-bottom:1px;
}
p{
margin-bottom:1px!important;

}
.searchbtn{

width: 11%;
padding: 5px;
background: radial-gradient(circle at 10% 20%, rgb(255, 197, 61) 0%, rgb(255, 94, 7) 90%); 

color: white;
font-size: 17px;
border: none;
border-left: none;
cursor: pointer;

}

#desktop{

  border-width:10px;
}


  </style>
</html>  