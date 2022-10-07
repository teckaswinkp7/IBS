@extends('admin.header')  
@section('content')
@include('admin.leftsidebar') 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ Session::get('message') }}</strong>
        </div>
        @endif 
        </div>
      </div>  
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a class="btn btn-success" href="{{route('grade.create')}}"> Create Grade</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Grade</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Grade</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Grade Name</th>
                  <th>Grade Min Percentage</th>
                  <th>Grade Max Percentage</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION['i'] = 0; ?>                        
                  @foreach ($grade as $grades)
                  <?php $_SESSION['i']=$_SESSION['i']+1; ?>
                    <tr>
                      <?php $dash=''; ?>
                      <td>{{$_SESSION['i']}}</td>
                      <td>{{ $grades->grade_name }}</td>
                      <td>{{ $grades->grade_min_percentage }}</td>
                      <td>{{ $grades->grade_max_percentage }}</td>
                      <td>
                        
                          <a  href="{{ route('grade.show',$grades->id) }}">   
                            <i class="fa-solid  fa-eye"></i>
                          </a>
                          &nbsp;
                          <a  href="{{ route('grade.edit',$grades->id) }}"> 
                            <i class="fa-solid fa-pen-to-square"></i>
                          </a>
                          <form method="POST" action="{{ route('grade.destroy', $grades->id) }}"style="display:inline-block;">
                            @csrf
                            <input name="_method" type="hidden" value="POST">
                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class="fa-solid fa-trash-can"></i></button>
                          </form>
                      </td>
                    </tr> 
                  @endforeach
                  <?php unset($_SESSION['i']); ?>    
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sl.No.</th>
                  <th>Grade Name</th>
                  <th>Grade Min Percentage</th>
                  <th>Grade Max Percentage</th>
                  <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                
              </div>
              <!-- /.card-body -->
            </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: 'Are you sure you want to delete this record?',
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
  @endsection
</body>
</html>  