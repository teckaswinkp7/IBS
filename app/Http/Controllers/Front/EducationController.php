<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Document;
use App\Models\User;
use App\Models\Payment;
use App\Mail\OfferEmail;
use App\Models\Sponsor;
use App\Models\Studentcourseoffer;
use App\Models\Bankdetails;
use App\Models\Studentcourse;
use App\Models\Courseselection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Session;
use DB;
class EducationController extends Controller
{
	/**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products = Product::all();

        //return view('products.index',compact('products'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepOne(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->get();
        return view('front.education.create-step-one',compact('user'));
        //return view('front/education.create-step-one');
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
        ]);

        if(empty($request->session()->get('user'))){
            $user = new User();
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }else{
            $user = $request->session()->get('user');
            $user->fill($validatedData);
            $request->session()->put('user', $user);
        }

        return redirect()->route('education.create.step.two');
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepTwo(Request $request)
    {
        //$education = $request->session()->get('education');
        $uid = Auth::id();
        $data = Document::where('stu_id',$uid)->first();
        $eduData = Education::where('stu_id',$uid)->first();
        //$data = DB::select( DB::raw("SELECT e.*,d.status FROM education e left join documents d on d.stu_id=e.stu_id WHERE e.stu_id = '".Auth::user()->id."'"));
        //dd($data);
        if(!empty($data))
        {
            if($data->status == 1)
            {
                //dd($data);
                //return redirect('dashboard');
                return redirect('education/docstatus');  
                
                //return view('front/education.create-step-two');
            }

            else if($data->status == 2)
            {
                //dd($data);
                //return redirect('dashboard');
                return redirect('education/docstatus');   
                //return view('front.education.create-step-two');
                //return view('front/education.create-step-two');
            }
            else
            {
                return view('front.education.create-step-two');
            }
        } 
        
        elseif($data == null && $eduData != null)
        {
            return redirect('education/docstatus'); 
           // return redirect('dashboard');
        }

        else
        {

            //return view('front.education.create-step-two');
            return view('front.education.documents');
        }
        
        //return view('front/education.create-step-two',compact('education'));
    }

    public function reupload()
    {
        //return view('front.education.create-step-two');
        return view('front.education.documents');
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    //public function postCreateStepTwo(Request $request)
    //{
    	/*$validatedData = $request->validate([
            'board' => 'required',
            'percentage' => 'required',
        ]);

        if(empty($request->session()->get('education'))){
            $education = new Education();
            $education->fill($validatedData);
            $request->session()->put('education', $education);
        }else{
            $education = $request->session()->get('education');
            $education->fill($validatedData);
            $request->session()->put('education', $education);
        }*/
        
        /*$validator = Validator::make($request->all(), [
            'board' => 'required',
            'percentage' => 'required',
            
        ]);*/
        /**New commented from here */
        /*$edu = new Education;
        $size = count(collect($request)->get('qualification'));
        
        for ($i = 0; $i < $size; $i++)
            {
                //
                $education = new Education;
                $id = Auth::id();
                $education->stu_id =$id;
                $education->qualification = $request->get('qualification')[$i];
                $education->board = $request->get('board')[$i];
                $education->percentage = $request->get('percentage')[$i];
                if($request->file('document')){
                    $file= $request->file('document')[$i];
                    $filename= rand(10,100).$file->getClientOriginalName();
                    $file->move(public_path('public/Image'), $filename);
                    $education->document= $filename;
                }
                $education->save();                  
            }
            $status = User::where('id', $id)->update(array('status' => 2));
            return redirect()->route('dashboard'); */  
            /*$file= $request->file('document');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $edu->document = $filename;*/
            //return response()->json(['success'=>'Added new records.']);
         
  
    //}

    public function postCreateStepTwo(Request $request)
    {
        //dd($request);
        $id = Auth::id();
        $board = $request->qualification;
        $percentage = 67;

        $id_images = $request->file('id_image');
        $id_image = str_replace(' ', '', $id_images->getClientOriginalName());
        $id_image_file = date('YmdHi').$id_image;        
        $id_images->move(public_path('public/Image'), $id_image_file);
        
        $highest_qualifications = $request->file('highest_qualification');
        $highest_qualification = str_replace(' ', '', $highest_qualifications->getClientOriginalName());
        $highest_qualification_file = date('YmdHi').$id_image;
        $highest_qualifications->move(public_path('public/Image'), $highest_qualification);

        $course_syopsiys = $request->file('course_syopsiy');
        $course_syopsiy = str_replace(' ', '', $course_syopsiys->getClientOriginalName());
        $course_syopsiy_file = date('YmdHi').$id_image;
        $course_syopsiys->move(public_path('public/Image'), $course_syopsiy_file);
        
        $data = array('stu_id'=>$id,'board'=>$board,'percentage'=>$percentage,'id_image'=>$id_image_file,'highest_qualification'=>$highest_qualification_file,'course_syopsiy'=>$course_syopsiy_file);
        
        $st = Education::create($data);
        
        $status = User::where('id', $id)->update(array('status' => 2));
        //return redirect()->route('dashboard');  
        return redirect('education/docstatus');  
    }

    public function docstatus()
    {
        $uid = Auth::id();
        $data['newval'] = Education::where('stu_id',$uid)->get();
        //dd($data['newval']);
        return view('front.education.document_submit',$data);       
    }

    public function insert_sponsor(Request $request)
    {
        $id = Auth::id();
        $val = Sponsor::create([
            'sponsor_name'    => $request->sponsor_name,
            'sponsor_email'   => $request->sponsor_email,
            'sponsor_phone'   => $request->sponsor_phone,
            'course_id'       => $request->course_id,
            'stu_id'          => $id               
        ]);
        if($val)
        {
            return redirect()->route('education.course.offer')
            ->with('success','Sponsor Inserted successfully.');
        }
        else
        {
            return redirect()->route('education.course.offer')
            ->with('danger','Error during sponsor insertion');
        }        
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStepThree(Request $request)
    {
        $product = $request->session()->get('product');

        return view('education.create-step-three',compact('product'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
    	$product = $request->session()->get('product');
        $product->save();

        $request->session()->forget('product');

        return redirect()->route('education.index');
    }

    public function getCourseOffers()
    {
        $id = Auth::id();
        $student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id",            
            "courses.name as courses_name",
            "courses.price",
            "studentcourseoffers.course_offer_description",
            "courseselections.offer_accepted",
            "courseselections.invoice_sent",
            "courseselections.invoice",
            "courseselections.receipt",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->join("studentcourseoffers","studentcourseoffers.stu_id", "=", "studentcourses.stu_id")
        ->join("courseselections","courseselections.stu_id", "=", "studentcourses.stu_id")
        ->where('studentcourses.stu_id','=',$id)
        ->get(); 
        
        $course_offer_unit = DB::table('units')->select('units.id','units.title','units.slug','units.short_text','units.unit_price','units.course_id')->
        join('courseselections','courseselections.StudentSelCid','=','units.course_id')->
        where('courseselections.stu_id','=',$id)->
        get();

        $unitselectionid = DB::table('unitselection')->select('unitselection.units_id')->where('unitselection.stu_id','=',$id)->get();

        $selectedid = explode(",", $unitselectionid);

        $bankdetails = Bankdetails::findOrFail(1);  
    	$userData = Studentcourseoffer::where('stu_id', $id)->get();
        $sponsorData = Sponsor::where('stu_id', $id)->first();        
        return view('front.education.course-offer',compact('student_course_offer','userData','bankdetails','sponsorData'));            
        
        //return redirect()->route('education.course.offer','userData','student_course_offer');
    }

    public function upload_invoice(Request $request)
    {
        $id = Auth::id();
        if($request->file('receipt')){
            $file= $request->file('receipt');
            $filename= time().rand(1000,9999).$file->getClientOriginalName();
            $file->move(public_path('uploads/receipt'), $filename);
            //$category->cat_image= $filename;
            
            $status = Courseselection::where('stu_id', $id)->update(array('receipt' => $filename));
            //dd($status == 1);
            if($status)
            {
                Session::flash('message', 'File uploaded successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('education/course-offer');
            }
            else
            {
                Session::flash('message', 'Error during upload!'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('education/course-offer');
            }
        }
    }

    public function upload_invoice_sponsor(Request $request)
    {
        $id = $request->stu_id;
        if($request->file('receipt')){
            $file= $request->file('receipt');
            $filename= time().rand(1000,9999).$file->getClientOriginalName();
            $file->move(public_path('uploads/receipt'), $filename);
            //$category->cat_image= $filename;
            
            $status = Courseselection::where('stu_id', $id)->update(array('receipt' => $filename));
            //dd($status == 1);
            if($status)
            {
                Session::flash('message', 'File uploaded successfully!'); 
                Session::flash('alert-class', 'alert-success');
                return redirect('education/view-student');
            }
            else
            {
                Session::flash('message', 'Error during upload!'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('education/view-student');
            }
        }

    }

    public function getStudents()
    {
        $id = Auth::id();
        $email = Auth::user()->email;
        $data['student_course_offer']= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id",            
            "courses.name as courses_name",
            "courses.price",            
            "courseselections.offer_accepted",
            "courseselections.invoice_sent",
            "courseselections.invoice",
            "users.name",
            "users.email",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->join("studentcourseoffers","studentcourseoffers.stu_id", "=", "studentcourses.stu_id")
        ->join("courseselections","courseselections.stu_id", "=", "studentcourses.stu_id")
        ->join("users","users.id","=","courseselections.stu_id")
        //->where('studentcourses.stu_id','=',$id)
        ->get(); 
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->get(); 
        $data['priceTotal'] = Sponsor::join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->sum('courses.price'); 
        $data['studentTotal'] = Sponsor::join('users','users.id', '=','sponsors.stu_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt',null)->count('users.id'); 
        $data['bankdetails'] = Bankdetails::findOrFail(1); 
        //$data['users'] = User::where('user_role',2)->get();
        //dd($data['sponsorDetails']);
        return view('front.education.student',$data);
        
    }

    public function getsponseredStudents()
    {
        $id = Auth::id();
        $email = Auth::user()->email;        
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('sponsors.sponsor_email',$email)->where('courseselections.receipt','!=','')->get();        
       
        //$data['users'] = User::where('user_role',2)->get();
        //dd($data['sponsorDetails']);
        return view('front.education.sponsered-student',$data);
        
    }

    public function sponsor_pay($id)
    {
        $email = Auth::user()->email;
        $sponsor_id = Auth::id();
        $student_id = $id;
        $data['sponsorDetails'] = Sponsor::select('users.name as student_name','users.email','courses.name as course_name','courses.price','courseselections.offer_accepted','courseselections.invoice_sent','courseselections.invoice','courseselections.receipt','sponsors.*')->join('users','users.id', '=','sponsors.stu_id')->join('courses','courses.id','=','sponsors.course_id')->join('courseselections','courseselections.stu_id','=','sponsors.stu_id')->where('users.id',$student_id)->first(); 
        $data['bankdetails'] = Bankdetails::findOrFail(1); 
        //dd($data['sponsorDetails']);
        return view('front.education.sponsor-payment',$data);
    }  
    
    public function searchSponsor(Requst $request)
    {
        $email = $request->email;
        $val = User::where('email',$email)->first();
        echo json_encode($val);
    }

    public function user_offer()
    {           
        
        return view('front.education.course-offer-new');
    }

    public function user_offer_accept()
    {
        $id = Auth::id();
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $student_course_offer= Courseselection::select("courses.name as courses_name")->join("courses","courses.id", "=", "courseselections.studentSelCid")->where('courseselections.stu_id','=',$id)->get();
        $data = array('offer_desc'=>"",'offer'=> 'Offer Email','filename'=>'ABC.txt','uname'=>$user->name);  
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new OfferEmail($data));
        Mail::to($email)->send(new OfferEmail($data));

        return view('front.education.offer-accepted',compact('student_course_offer'));
    }

    public function user_offer_congrats()
    {
        $id = Auth::id();
        $student_course_offer= Courseselection::select("courses.name as courses_name","users.name as uname")->join("courses","courses.id", "=", "courseselections.studentSelCid")->join("users","courseselections.stu_id","=", "users.id")->where('courseselections.stu_id','=',$id)->get();
        //dd($student_course_offer);
        /*$student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id",            
            "courses.name as courses_name",  
            "users.name as uname"          
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->join("studentcourseoffers","studentcourseoffers.stu_id", "=", "studentcourses.stu_id")
        ->join("courseselections","courseselections.stu_id", "=", "studentcourses.stu_id")
        ->join("users","users.id", "=", "studentcourses.stu_id")
        ->where('studentcourses.stu_id','=',$id)
        ->get();   */ 
        return view('front.education.offer-congrats',compact('student_course_offer'));
    }


    public function coursedefer(){

        return view('front.education.coursedefer');
    }

    public function coursesdefer(Request $request){

        $id = Auth::id();

        $defercourse = courseselection::updateOrCreate(
            [
                'stu_id' => $id
            ],
            [

            'defer_course' => $request->defer_course,
        ]);
        
        if($request->defer_course == 'yes')
        {
            return view('front.education.coursedeferdate');
        }
        else{
 
            return redirect('userprofile');
        }
    }

    public function coursedeferdate(){

        return view('front.education.coursedeferdate');
    }
    
    public function coursedefersdate(Request $request){

        $id = Auth::id();

        $defercoursedate = courseselection::updateOrCreate(
            [
                'stu_id' => $id
            ],
            [

            'defer_date' => date("Y-m-d", strtotime($request->defer_date)),
        ]);
        
        return redirect('userprofile');
    }



    public function courseofferpost(Request $request){

        $id = Auth::id();

        $offeraccepted = User::findorfail($id);

        $offeraccepted->offer_accepted = $request->accepted;

        $offeraccepted->save();

    $courseoffer = Payment::updateOrCreate([
  
 
    'stu_id' =>$id

],[

    'status'          => 'Registered',
    'offer_accepted'  =>  $request->accepted,



  ]);

  if($request->accepted == 'yes') {
   
    return redirect()->route('courseApproved');

  }
  else{

    return redirect()->route('useroffer');

  }
  }
}
