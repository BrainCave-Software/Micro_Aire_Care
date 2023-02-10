<?php

use App\Http\Controllers\CustomerAPI\AuthController;
use App\Http\Controllers\CustomerAPI\CustomerController;
use App\Http\Controllers\CustomerAPI\VariationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;




header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');




Route::middleware('auth:sanctum')->group(function () {

    // Route::get('view-profile');
    Route::post('update-profile', [CustomerController::class, 'updateprofile']); //edit profile /4
    Route::post('update-client', [CustomerController::class, 'updateClient']);
    Route::post('update-employee', [CustomerController::class, 'updateemployee']);
    Route::get('profile/{id}', [CustomerController::class, 'viewprofile']); // profile  /3

    // Enabling and Desabling Clocking Button

    Route::get('/clocking', [CustomerController::class, 'clocking']);
});


Route::get('all-user', [AuthController::class, 'getdata']);
Route::post('signin', [AuthController::class, 'login']); // Login    /1
Route::post('signup', [AuthController::class, 'register']);

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);  //2
Route::post('reset-password', [AuthController::class, 'resendPin']);

Route::post('change-password', [AuthController::class, 'changepswd']); // change password  /6
Route::get('customer-management/{id}', [CustomerController::class, 'customers']);
Route::get('job-sheet/{employee_id}', [CustomerController::class, 'jobsheet']); //job sheet  /7
Route::get('jobsheet-details/{project_id}', [CustomerController::class, 'jobsheetdetail']); //job sheetdetails by id  /8

Route::get('job-descriptions/{employee_id}/{project_id}', [CustomerController::class, 'jobdescriptions']); //job discription   /9
Route::get('jobdescriptions-detail', [CustomerController::class, 'jobdescriptionsdetail']); //job discription by id /10

Route::get('job-history/{employee_id}', [CustomerController::class, 'JobHistory']); //Making JobHiatory  /14

Route::post('upload-img', [CustomerController::class, 'ImageUpload']);   // 11


// Route::post()
Route::post('employee-attendence/clock-in', [CustomerController::class, 'clockIn']); // attendance  /5
Route::post('employee-attendence/clock-out', [CustomerController::class, 'clockOut']); // attendance  /5

//  variation
Route::post('add-variation', [VariationController::class, 'addVariation']);
Route::get('get-variation/{user_id}/{sub_task_id}', [VariationController::class, 'getVariation']);
