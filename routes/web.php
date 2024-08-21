<?php

use App\Http\Controllers\ContactController;
use App\Http\Middleware\TokenverificationMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//!web API Routes
Route::post('/user_registration',[UserController::class,'UserRegistration'])->name('user_registration');
Route::post('/user_login',[UserController::class,'UserLogin'])->name('user_login');
Route::post('/send-otpcode',[UserController::class,'SendOTPCode'])->name('send-otpcode');
Route::post('/verify-otp',[UserController::class,'VerifyOTP'])->name('verify-otp');
Route::post('/reset-password',[UserController::class,'PasswordReset'])->name('reset-password')->middleware([TokenverificationMiddleware::class]);


//page Routes
Route::get('/userLogin',[UserController::class,'LoginPage'])->name('userLogin');
Route::get('/userRegistration',[UserController::class,'RegistrationPage'])->name('userRegistration');
Route::get('/sendOTP',[UserController::class,'SendOTPPage'])->name('sendOTP');
Route::get('/verifyOTP',[UserController::class,'VerifyOTPPage'])->name('verifyOTP');
Route::get('/resetPassword',[UserController::class,'ResetPasswordPage'])->name('resetPassword');
Route::get('/dashboard',[DashboardController::class,'DashboardPage'])/* ->middleware([TokenverificationMiddleware::class]) */;
Route::get('/userProfile',[UserController::class,'UserProfilePage'])/* ->middleware([TokenverificationMiddleware::class]) */;
Route::get('/categoryPage',[CategoryController::class,'CategoryPage']);
Route::get('/customerPage',[CustomerController::class,'CustomerPage']);
Route::get('/productPage',[ProductController::class,'ProductPage']);
Route::get('/invoicePage',[InvoiceController::class,'InvoicePage']);
Route::get('/salePage',[InvoiceController::class,'SalePage']);
Route::get('/reportPage',[ReportController::class,'ReportPage']);