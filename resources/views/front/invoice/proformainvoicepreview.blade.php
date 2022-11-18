@extends('front/header')  
@section('content') 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('assets/custom/common.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>  
<link rel="stylesheet" href="{{asset('assets/custom/profile.css')}}">
<style>

.edit-course {
    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:5px;
    color: rgba(0, 0, 0, 0.8);
    background-color: rgba(255, 255, 255, 0.8);
    transition: all .3s ease;
    border: 1px solid #d9d9d9;
   }
   .edit-course2{

    display: block;
    height: 100%;
    padding: 12px;
    text-decoration: none;
    margin-bottom: 6px;
    border-radius: 6px;
    line-height:5px;
    color: rgba(0, 0, 0, 0.8);
    background-color: #ffd4ca;
    transition: all .3s ease;
    border: 1px solid #d9d9d9;

   }
   

   .congrats-letter{
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.6);
    border-radius: 6px;
   }

   .congrats-letter ul{
    list-style: number;
   }
   .print-download-btn{
    margin-top: 30px;
   }

    .print-download-btn button{
    padding: 3px 6px;
    background-color: #cc6600;
    color: white;
    transition: background .4s ease;
    border: none;
}

.print-download-btn button:hover{
    background-color: black;
    color: white;

}

.total{
font-weight:bold;
}

.edit-btn{

    position:relative;
    bottom:60px;
    padding: 15px 20px;
    background-color: #cc6600;
    color:white;

}
.edit-btn2{
  position:relative;
    bottom:30px;
padding: 15px 20px;
background-color: #cc6600;
color:white;

}

.edit-btn2 > a {
    color:white;
    text-decoration:none;
}
.edit-btn > a{
  color:white;
    text-decoration:none;
}

.down > a{
    color:white;
    text-decoration:none;
}
*{
   list-style-type: none;
}

nav ul li a:hover{
   color:#51be78;
}

 .bill {
   position:static;
   display:block;
}
.bill.show{
   display:block;
}



.bill-show{

   display:none;
}

nav ul li a span{
   position:absolute;
   top:50%;
   right:20px;
   transform:translateY(-50%);
   transition:transform 0.4s;
}

nav ul li a:hover span{

   transform:translateY(-50%) rotate(-180deg);
}
.profile-modal{

  background:#EDEDED;
}

</style>

    <div class="background-profile" style="margin-top: 100px;"> 
        <div class="profile-modal">
            <div class="profile-logo">
                <a href="#"><img src="profile-logo.png" alt="" width="100px"></a>
            </div>  
            <h3> Proforma invoice </h3>
            
            <div class="row">
                <div class="col-sm-3">
                    <div class="profile-course">
                        <a href="#">Profile</a>
                        <a href="#">Course</a>
                        <li><a class="bill-btn" href="#">bill
                    <span class="fas fa-caret-down"> </span>
                    <li class="bill-show">
                  <li class="bill"><a href="proformainvoice">Pro-forma-invoice</a></li>
                  <li class="bill"><a href="salesinvoice">Sales Invoice</a></li>
                  <li class="bill"><a href="payment">Payment</a></li>
                  <li class="bill"><a href="history">History</a></li>
</li>
                    </a></li>
                    </div>
                </div>
                <div class="col-sm-9">
                   
                    <form action="">
                      <div class="edit-course">
                        {{-- <a href="#">
                          Accounting and Finance 
                        </a> --}}
                        
                        <p > Course: {{$student_course_offer[0]->courses_name}}</p>
                        <p> Name: {{$user->name}}</p>
                        <p> Address: {{$location->current_location}} </p>
                        <p> Email: {{$user->email}}</p>
                        <p> Phone: {{$user->phone}}</p>
                      <button class="d-flex edit-btn float-right" > <a href="{{route('proformainvoice')}}">  Edit </button> </a>
                        </div>
                        <div class="congrats-letter">
                        <img class="float-right" src="{{asset('assets/front/images/IBS-Logo.png')}}" alt="" width="150px"></img>
                        </br>
                        </br>
                            <h4> Pro Forma Invoice : {{$invoicedata[0]->invoiceno}}</h4>
                            <p>  <?php echo date("M d Y"); ?></p>
                           

                                                        
<div class="receipt-content">
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="invoice-wrapper">

					<div class="payment-details">
						<div class="row">
							<div class="col-sm-6">
								<span>invoice to: </span></br>
								<strong>
									{{$location->current_location}}
								</strong>
								<p>
                                    
                                    
                                    {{$location->current_address_location}}
									{{-- 989 5th Avenue <br>
									City of monterrey <br>
									55839 <br>
									USA <br> --}}
									<a href="#">
                                        
                                        {{$user->email}}
									</a>
								</p>
							</div>
							<div class="col-sm-6 text-right">
								<span>Issued By,</span></br>
								<strong>
									IBS University
								</strong>
								<p>
									P.O Box 2826 Boroko <br>
									NCD Port Moresby <br>
									<a href="#">
										ask@ibs.ac.pg
									</a>
								</p>
							</div>
						</div>
					</div>

					<div class="line-items">
						<div class="headers clearfix">
							<div class="row">
								<div class="col-xs-4">Item: </div>
							
								<div class="col-xs-5 text-right">Amount: </div>
							</div>
						</div>
						<div class="items">
                            @php 
                            $total = 0;
                            @endphp
                        @foreach((array)$unitsData as $unit)
                        <div class="row item">
                      
								<div class="col-xs-4 desc">
                                {{$unit}}
								</div>
                                <div class="col-xs-5 amount text-right">
                                @php   
                                $data = DB::table('units')->select('unit_price')->where('title',$unit)->get(); 
                               $price = json_decode('data');           
                              echo $data[0]->unit_price;
                              $total = $total + $data[0]->unit_price;
                            @endphp    
								</div>
							</div>
                           </div>
                
@endforeach 
                    @foreach((array)$courseData as $semester)
                           <div class="row item">
                         
								<div class="col-xs-4 desc">
                                {{$semester}}
								</div>
								<div class="col-xs-5 amount text-right">
                                @php   
                                $data = DB::table('sem')->select('price')->where('name',$semester)->get();           
                              echo $data[0]->price;
                              $total = $total + $data[0]->price;
                            @endphp   
								</div>
							</div>
						</div>
                     
                   
@endforeach     
                            @foreach($exist as $val)
							<div class="row item">
								<div style="width:700px;" class="col-xs-10 desc">
									{{$val}}
								</div>
								<div class="col-xs-5 amount text-right">
								@php 
                                 $data = DB::table('additionalfee')->select('price')->where('title',$val)->get();
                                 $price = json_decode('data');
                                 echo $data[0]->price;
                                 $total = $total + $data[0]->price;
                                 @endphp
								</div>
							</div>
                         @endforeach

      
                           
						<div class="total">
							<div  class="field total">
								Total Amount Payable:   <span id="total" name="total"  class="col-xs-5 float-right">
                            
                                         {{$total}}


                                     </span>
							</div>	
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>                    
                                
                        </div>
                      </div>
                      
                      
                      <div class="print-download-btn">
                      <a href="{{route('proformainvoice')}}"><button class="down"><img src="{{asset('assets/custom/edit-icon.png')}}" alt="" width="15px"> Edit  </a></button>
                      <a href="{{route('invoice')}}"><button class="down"><img src="{{asset('assets/custom/download-icon.png')}}" alt="" width="15px"> Download </a></button>
                        <button class="print"> Print <img src="{{asset('assets/custom/print-icon.png')}}" alt="" width="15px"></button>    
                    </div>

                    
                   </form>
                  </br>
                  </br>

                   <form action="{{route('totalpost')}}" method="post">
                    @csrf
                   <div class="edit-course2">
                        
            <p >When you are ready to make payment,</p> 
            <p>  click on the “Request Invoice” button to obtain your official invoice :  ​</p>
                  
            <input id="total" type="hidden" name="amountdue" value="{{$total}}" class="col-xs-5 float-right">
                            
                            </input>
                      <button type="submit" class="d-flex edit-btn2 float-right" >  Request Invoice </button> 
                        </div>
                  </form>
               
                                    </div>
                                    </div>
                                    </div>
                  </div>
 @include('front/footer')      
@endsection  