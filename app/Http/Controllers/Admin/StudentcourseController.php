<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Courses;
use App\Models\Studentcourse;
use App\Models\Studentcourseoffer;
use App\Models\Courseselection;
use App\Mail\OfferEmail;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;
use Hash;
use DB;
class StudentcourseController extends Controller
{
    //
    public function index()
    {
        $data = User::join('courseselections', 'courseselections.stu_id', '=', 'users.id')
        ->join('courses','courses.id', '=', 'courseselections.studentSelCid')
        ->where('courseselections.offer_accepted', '=', 0)
        ->get(['users.*','courseselections.studentSelCid','courses.name as csname']);               
        return view('admin.stucourse.index', compact('data'));         
    }

    public function courseoffer($id)
    {
        //dd($id);
        //$users = User::where('user_role',2)->where('status',5)->get();
        $users = User::where('id',$id)->get();
        //dd($users);
        //$uid=$users[0]->id;
        $uid=(int) $id;
        //dd($uid);
        //DB::enableQueryLog();
        $student_course_offer= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get(); 
        //dd($student_course_offer);
        
        // $query = DB::getQueryLog();
        // dd($query);
        return view('admin.stucourse.courseoffer',compact('student_course_offer','users'));
    }

    public function sendcourseInvoice($id)
    {        
        $users = User::where('id',$id)->get();        
        $uid=(int) $id;        
        $student_course_invoice= Studentcourse::select(
            "studentcourses.student_course_id", 
            "studentcourses.stu_id",
            "studentcourses.student_course_id", 
            "courses.name as courses_name",
        )
        ->join("courses", "courses.id", "=", "studentcourses.student_course_id")
        ->where('studentcourses.stu_id','=',$uid)
        ->get();         
        return view('admin.stucourse.sendInvoice',compact('student_course_invoice','users'));
    }

    public function store(Request $request)
    {
        $offer = new Studentcourseoffer;
        $course_offer = $request->all();
        $offer=$request->course_offer_description;
        $course_offer=Studentcourseoffer::create([
            'stu_id'         => $request->stu_id,
            'offer_course_id'    => $request->offer_course_id,
            'course_offer_description'    => $request->course_offer_description,
        ]);
        $id=$request->stu_id;
        //$id = 10;
        //$status = User::where('id', $id)->update(array('status' => 6));
        $status = Courseselection::where('stu_id', $id)->update(array('offer_generated' => 1));
        $data = array('offer_desc'=>"$request->course_offer_description",'offer'=> $offer);  
        Mail::to($request->stu_email)->send(new OfferEmail($data));
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new OfferEmail($data));
        return redirect('admin/studentcourse');
        //->with('success','created successfully.');
    }

    public function storeInvoice(Request $request)
    {
        $offer = new Studentcourseoffer;
        $course_offer = $request->all();
        $offer=$request->course_offer_description;        
        $id=$request->stu_id;                

        $file= $request->file('attachment');
        $path = public_path('uploads/attachment/');
        $filename= rand(0000,9999).$file->getClientOriginalName();
        $file->move(public_path('public/uploads/attachment'), $filename);        
        $data = array('offer_desc'=>"$request->course_offer_description",'offer'=> $offer,'filename'=>$filename);
        $status = Courseselection::where('stu_id', $id)->update(array('invoice_sent' => 1,'invoice' => $filename)); 
        Mail::to($request->stu_email)->send(new InvoiceEmail($data));  
        //Mail::to('vedmanimoudgal@virtualemployee.com')->send(new InvoiceEmail($data));        
        return redirect('admin/studentcourse/invoice');       
    }

    public function invoice()
    {
        $data = User::join('courseselections', 'courseselections.stu_id', '=', 'users.id')
        ->join('courses','courses.id', '=', 'courseselections.studentSelCid')
        ->where('courseselections.offer_accepted', '=', 1)
        ->where('courseselections.invoice_sent', '=', 1)
        ->get(['users.*','courseselections.studentSelCid','courses.name as csname']);
               
        return view('admin.stucourse.invoice', compact('data'));  
    }

    public function viewReceipt()
    {
        $data = User::join('courseselections', 'courseselections.stu_id', '=', 'users.id')
        ->join('courses','courses.id', '=', 'courseselections.studentSelCid')
        ->where('courseselections.offer_accepted', '=', 1)
        ->where('courseselections.invoice_sent', '=', 1)
        ->where('courseselections.receipt', '!=', null)
        ->get(['users.*','courseselections.studentSelCid','courseselections.receipt','courses.name as csname']);
               
        return view('admin.stucourse.receipt', compact('data'));  
    }

    public function view_student()
    {
        $data = User::join('courseselections', 'courseselections.stu_id', '=', 'users.id')
        ->join('courses','courses.id', '=', 'courseselections.studentSelCid')        
        ->get(['users.*','courseselections.studentSelCid','courseselections.receipt','courses.name as csname','courses.price']);
               
        return view('admin.stucourse.student', compact('data')); 
    }
}
