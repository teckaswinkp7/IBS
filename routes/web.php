<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Front\Auth\AuthControllers;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\ProductCRUDController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\EducationController;
use App\Http\Controllers\Admin\ScreeningController;
use App\Http\Controllers\Admin\DocumentVerificationController;
use App\Http\Controllers\Admin\StudentcourseController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\registeredstudentscontroller;
use App\Http\Controllers\Admin\confirmedstudentscontroller;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\AssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
//Auth::routes(['verify' => true]);
Route::get('/',[WelcomeController::class, 'index'])->middleware('cors');;
Route::get('send-mail', 'App\Http\Controllers\MailController@sendMail')->name('send.mail');
Route::post('otp-validate', [AuthControllers::class, 'validateOtp'])->name('validateOtp');
Route::post('otp-resend', [AuthControllers::class, 'resendOtp'])->name('resendOtp');
Route::get('registration', [AuthControllers::class, 'registration'])->name('registers');
Route::post('post-registration', [AuthControllers::class, 'postRegistration'])->name('register.post'); 
Route::get('admin/login', [AuthController::class, 'index'])->name('admin_login');
Route::post('admin/post-login', [AuthController::class, 'postLogin'])->name('admin/login.post'); 
Route::get('login', [AuthControllers::class, 'index'])->name('login');
Route::post('post-login', [AuthControllers::class, 'postLogin'])->name('login.post');
Route::post('admin/post-registration', [AuthController::class, 'postRegistration'])->name('admin/register.post'); 
Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('admin-dashboard'); 
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin/logout');
Route::get('dashboard', [AuthControllers::class, 'dashboard'])->name('dashboard'); 
Route::get('profile', [AuthControllers::class, 'profile'])->name('update-profile');
Route::get('logout', [AuthControllers::class, 'logout'])->name('logout.front');
Route::resource('admin/courses', CoursesController::class);
Route::resource('admin/categories', CategoryController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/role', RoleController::class);
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/user', UserController::class);
});
Route::get('admin/screening', 'App\Http\Controllers\Admin\ScreeningController@index')->name('screening.index');
Route::get('admin/enrollment/', 'App\Http\Controllers\Admin\DocumentVerificationController@index')->name('enrollment.index');
Route::get('admin/enrollment/verify/{id}', 'App\Http\Controllers\Admin\DocumentVerificationController@verify')->name('enroll.verify');
Route::post('admin/enrollment/store', [DocumentVerificationController::class, 'store'])->name('enrollment.store');
Route::post('admin/screening/store', [ScreeningController::class, 'store'])->name('screening.store');
Route::get('admin/screening/course/{id}', [ScreeningController::class, 'course'])->name('screening.course');
Route::post('admin/subcat', 'App\Http\Controllers\Admin\CoursesController@subCat')->name('subcat');
Route::get('education-profile', [EducationController::class, 'index']);
Route::post('education-receipt', [EducationController::class, 'upload_invoice'])->name('education.receipt');
Route::post('education-receipt-sponsor', [EducationController::class, 'upload_invoice_sponsor'])->name('education.sponsor.receipt');
Route::get('admin/studentcourse/', [StudentcourseController::class, 'index'])->name('studentcourse.index');
Route::get('admin/studentcourse/courseoffer/{id}', [StudentcourseController::class, 'courseoffer'])->name('student.courseoffer');
Route::get('admin/studentcourse/sendcourseInvoice/{id}', [StudentcourseController::class, 'sendcourseInvoice'])->name('student.sendcourseInvoice');
Route::get('admin/studentcourse/viewReceipt/', [StudentcourseController::class, 'viewReceipt'])->name('studentcourse.viewReceipt');
Route::get('admin/studentcourse/viewStudent/', [StudentcourseController::class, 'view_student'])->name('studentcourse.viewStudent');
Route::get('admin/studentcourse/viewInvoice/', [StudentcourseController::class, 'view_invoice'])->name('studentcourse.viewInvoice');
Route::get('admin/studentcourse/viewOffer/', [StudentcourseController::class, 'view_offer'])->name('studentcourse.viewOffer');

Route::post('admin/studentcourse/store/', [StudentcourseController::class, 'store'])->name('studentcourse.store');
Route::post('admin/studentcourse/storeInvoice/', [StudentcourseController::class, 'storeInvoice'])->name('studentcourse.storeInvoice');

Route::get('admin/studentcourse/invoice/', [StudentcourseController::class, 'invoice'])->name('studentcourse.invoice');
Route::get('admin/bank/', [BankController::class, 'index'])->name('bank.index');
Route::get('admin/bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
Route::post('admin/bank/update/{id}', [BankController::class, 'update'])->name('bank.update');

Route::get('admin/sponsor/', [SponsorController::class, 'index'])->name('sponsor.index');
Route::get('education/pay-sponsor/{id}', [EducationController::class, 'sponsor_pay'])->name('sponsor.pay');

Route::post('edit-profile', [EducationController::class, 'store']);
Route::post('student-course', [AuthControllers::class, 'studentCoursestore'])->name('student.course');
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('education/create-step-one',[EducationController::class, 'createStepOne'])->name('education.create.step.one');
Route::post('education/create-step-one',[EducationController::class, 'postCreateStepOne'])->name('education.create.step.one.post');
Route::get('education/course-offer',[EducationController::class, 'getCourseOffers'])->name('education.course.offer');
Route::get('education/view-student',[EducationController::class, 'getStudents'])->name('education.view.student');
Route::get('education/view-sponsered',[EducationController::class, 'getsponseredStudents'])->name('education.sponsored.student');
Route::post('education/add-sponsor',[EducationController::class, 'insert_sponsor'])->name('education.sponsor');
Route::post('searchSponsor',[EducationController::class, 'searchSponsor'])->name('searchSponsor');


Route::get('education/create-step-two',  [EducationController::class, 'createStepTwo'])->name('education.create.step.two');
Route::get('education/reupload',  [EducationController::class, 'reupload'])->name('education.reupload');
Route::post('education/create-step-two', [EducationController::class, 'postCreateStepTwo'])->name('education.create.step.two.post');

Route::get('education/create-step-three', 'EducationController@createStepThree')->name('products.create.step.three');
Route::post('education/create-step-three', 'EducationController@postCreateStepThree')->name('products.create.step.three.post');
Route::post('approve/{id}', [AuthControllers::class, 'approve'])->name('approve');
Route::post('decline/{id}', [AuthControllers::class, 'decline'])->name('decline');

Route::get('education/courseApproved', [AuthControllers::class, 'approve_course'])->name('courseApproved');
Route::get('education/courseDenied', [AuthControllers::class, 'deny_course'])->name('courseDenied');

Route::get('generate-invoice/{id}', [PDFController::class, 'generateInvoicePDF'])->name('generate.invoice');
Route::get('generate-invoice-pdf', array('as'=> 'generate.invoice.pdf', 'uses' => 'PDFController@generateInvoicePDF'));

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/reports/registeredstudents/', [registeredstudentscontroller::class, 'index'])->name('admin.reports.registeredstudents.index');
    Route::get('admin/reports/registeredstudents/view/{id}', [registeredstudentscontroller::class, 'show'])->name('admin.reports.show.show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/reports/confirmedstudents/', [confirmedstudentscontroller::class, 'index'])->name('admin.reports.confirmedstudents.index');
    Route::get('admin/reports/confirmedstudents/view/{id}', [confirmedstudentscontroller::class, 'confirmedshow'])->name('admin.reports.confirmedshow.confirmedshow');
});

/**Grade Backend**/
Route::get('admin/grade', 'App\Http\Controllers\Admin\GradeController@index')->name('grade.index');
Route::get('admin/grade/create', 'App\Http\Controllers\Admin\GradeController@create')->name('grade.create');
Route::post('admin/grade/store', 'App\Http\Controllers\Admin\GradeController@store')->name('grade.store');
Route::post('admin/grade/destroy/{id}', 'App\Http\Controllers\Admin\GradeController@destroy')->name('grade.destroy');
Route::get('admin/grade/show/{id}', 'App\Http\Controllers\Admin\GradeController@show')->name('grade.show');
Route::get('admin/grade/edit/{id}', 'App\Http\Controllers\Admin\GradeController@edit')->name('grade.edit');
Route::post('admin/grade/update/{id}', 'App\Http\Controllers\Admin\GradeController@update')->name('grade.update');

/**Assignment Backend**/
Route::get('admin/assignment', 'App\Http\Controllers\Admin\AssignmentController@index')->name('assignment.index');
Route::get('admin/assignment/create', 'App\Http\Controllers\Admin\AssignmentController@create')->name('assignment.create');
Route::post('admin/assignment/store', 'App\Http\Controllers\Admin\AssignmentController@store')->name('assignment.store');
Route::post('admin/assignment/destroy/{id}', 'App\Http\Controllers\Admin\AssignmentController@destroy')->name('assignment.destroy');
Route::get('admin/assignment/show/{id}', 'App\Http\Controllers\Admin\AssignmentController@show')->name('assignment.show');
Route::get('admin/assignment/edit/{id}', 'App\Http\Controllers\Admin\AssignmentController@edit')->name('assignment.edit');
Route::get('admin/assignment/update/{id}', 'App\Http\Controllers\Admin\AssignmentController@update')->name('assignment.update');

/**Student Assignment Front */
Route::get('front/assignment', 'App\Http\Controllers\Front\StudentAssignmentController@index')->name('studentassignment.index');

/**Student Assignment Submission Front */
Route::get('front/assignmentsubmission/submit/{id}', 'App\Http\Controllers\Front\AssignmentsubmissionController@submit')->name('assignmentsubmit.submit');
Route::post('front/assignmentsubmission/store/', 'App\Http\Controllers\Front\AssignmentsubmissionController@store')->name('assignmentsubmit.store');

/**Assignmentgrade Backend**/
Route::get('admin/assignmentgrade/', 'App\Http\Controllers\Admin\AssignmentGradeController@index')->name('assignmentgrade.index');
Route::get('admin/assignmentgrade/grade/{id}', 'App\Http\Controllers\Admin\AssignmentGradeController@grade')->name('assignmentgrade.grade');
Route::get('admin/assignmentgrade/store/', 'App\Http\Controllers\Admin\AssignmentGradeController@store')->name('assignmentgrade.store');

/**Exam Backend */
Route::get('admin/exam', 'App\Http\Controllers\Admin\ExamController@index')->name('exam.index');
Route::get('admin/exam/create', 'App\Http\Controllers\Admin\ExamController@create')->name('exam.create');
Route::post('admin/exam/store', 'App\Http\Controllers\Admin\ExamController@store')->name('exam.store');
Route::get('admin/exam/show/{id}', 'App\Http\Controllers\Admin\ExamController@show')->name('exam.show');
Route::get('admin/exam/edit/{id}', 'App\Http\Controllers\Admin\ExamController@edit')->name('exam.edit');
Route::get('admin/exam/update/{id}', 'App\Http\Controllers\Admin\ExamController@update')->name('exam.update');
Route::post('admin/exam/destroy/{id}', 'App\Http\Controllers\Admin\ExamController@destroy')->name('exam.destroy');

/**Student View Exam Details Front */
Route::get('front/studentexam', 'App\Http\Controllers\Front\StudentExamController@index')->name('studentexam.index');
Route::get('front/studentexam/show/{id}', 'App\Http\Controllers\Front\StudentExamController@show')->name('studentexam.show');