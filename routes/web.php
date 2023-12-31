<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\HolidayController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\Backend\FileManagerController;

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

Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('register',[RegisterController::class,'store']);
Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'login']);

Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');
Route::post('forgot-password',[ForgotPasswordController::class,'reset']);


Route::get('job-list',[JobController::class,'index'])->name('job-list');
Route::get('job-view',[JobController::class,'show'])->name('job-view');


Route::group(['middleware'=>['auth']], function (){
    
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('logout',[LogoutController::class,'index'])->name('logout');

    //apps routes
    Route::get('events',[EventController::class,'index'])->name('events');
    Route::get('contacts',[ContactController::class,'index'])->name('contacts');
    Route::post('contacts',[ContactController::class,'store']);
    Route::delete('contacts',[ContactController::class,'destroy'])->name('contact.destroy');
    Route::get('file-manager',[FileManagerController::class,'index'])->name('filemanager');

    Route::get('holidays',[HolidayController::class,'index'])->name('holidays');
    Route::post('holidays',[HolidayController::class,'store']);
    Route::post('holidays/{holiday}',[HolidayController::class,'completed'])->name('completed');
    Route::put('holidays',[HolidayController::class,'update']);
    Route::delete('holidays',[HolidayController::class,'destroy'])->name('holiday.destroy');


    Route::get('departments',[DepartmentController::class,'index'])->name('departments');
    Route::post('departments',[DepartmentController::class,'store']);
    Route::put('departments',[DepartmentController::class,'update']);
    Route::delete('departments',[DepartmentController::class,'destroy'])->name('department.destroy');

    Route::get('designations',[DesignationController::class,'index'])->name('designations');
    Route::post('designations',[DesignationController::class,'store']);
    Route::delete('designations',[DesignationController::class,'destroy'])->name('designation.destroy');

});

Route::get('',function (){
    return redirect()->route('dashboard');
});


