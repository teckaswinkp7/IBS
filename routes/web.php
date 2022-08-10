<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Front\Auth\AuthControllers;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\ProductCRUDController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Front\WelcomeController;
use App\Http\Controllers\Admin\RoleController;

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

Route::get('/',[WelcomeController::class, 'index'])->middleware('cors');;
//Route::resource('/', WelcomeController::class);
//Route::get('/', [WelcomeController::class]);
Route::get('registration', [AuthControllers::class, 'registration'])->name('register');
Route::get('admin/login', [AuthController::class, 'index'])->name('admin_login');
Route::post('admin/post-login', [AuthController::class, 'postLogin'])->name('admin/login.post'); 
Route::get('login', [AuthControllers::class, 'index'])->name('login');
Route::post('post-login', [AuthControllers::class, 'postLogin'])->name('login.post'); 
//Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthControllers::class, 'postRegistration'])->name('register.post'); 
Route::get('admin/dashboard', [AuthController::class, 'dashboard'])->name('admin-dashboard'); 
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin/logout');
Route::get('dashboard', [AuthControllers::class, 'dashboard'])->name('dashboard'); 
Route::get('logout', [AuthControllers::class, 'logout'])->name('logout');
Route::resource('admin/courses', CoursesController::class);
Route::resource('admin/categories', CategoryController::class);
Route::resource('admin/role', RoleController::class);
//Route::resource('product', ProductCRUDController::class);
//Route::resource('product','App\Http\Controllers\ProductCRUDController')->names('product');
Route::post('admin/subcat', 'App\Http\Controllers\CoursesController@subCat')->name('subcat');
