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

//!User API Routes
Route::post('/user_registration', [UserController::class, 'UserRegistration'])->name('user_registration');
Route::post('/user_login', [UserController::class, 'UserLogin'])->name('user_login');
Route::post('/send_otpcode', [UserController::class, 'SendOTPCode'])->name('send_otpcode');
Route::post('/verify_otp', [UserController::class, 'VerifyOTP'])->name('verify_otp');
Route::post('/reset_password', [UserController::class, 'PasswordReset'])->name('reset_password')->middleware([TokenverificationMiddleware::class]);

Route::get('/userProfile', [UserController::class, 'UserProfile'])->name('userProfile')->middleware([TokenverificationMiddleware::class]);
Route::post('/updateProfile', [UserController::class, 'UpdateProfile'])->name('updateProfile')->middleware([TokenverificationMiddleware::class]);

Route::get('/logout', [UserController::class, 'UserLogout'])->name('logout');

//!Category API Routes
Route::get('/categoryList',[CategoryController::class,'CategoryList'])->name('categoryList')->middleware([TokenverificationMiddleware::class]);
Route::post('/categoryCreate',[CategoryController::class,'CategoryCreate'])->name('categoryCreate')->middleware([TokenverificationMiddleware::class]);
Route::post('/categoryUpdate',[CategoryController::class,'CategoryUpdate'])->middleware([TokenverificationMiddleware::class]);
Route::delete('/categoryDelete',[CategoryController::class,'CategoryDelete'])->middleware([TokenverificationMiddleware::class]);
//!page Routes
Route::get('/userLogin', [UserController::class, 'LoginPage'])->name('userLogin');
Route::get('/userRegistration', [UserController::class, 'RegistrationPage'])->name('userRegistration');
Route::get('/sendOTP', [UserController::class, 'SendOTPPage'])->name('sendOTP');
Route::get('/verifyOTP', [UserController::class, 'VerifyOTPPage'])->name('verifyOTP');
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenverificationMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([TokenverificationMiddleware::class]);
Route::get('/profilePage', [UserController::class, 'UserProfilePage'])->middleware([TokenverificationMiddleware::class]);
Route::get('/categoryPage', [CategoryController::class, 'CategoryPage']);
Route::get('/customerPage', [CustomerController::class, 'CustomerPage']);
Route::get('/productPage', [ProductController::class, 'ProductPage']);
Route::get('/invoicePage', [InvoiceController::class, 'InvoicePage']);
Route::get('/salePage', [InvoiceController::class, 'SalePage']);
Route::get('/reportPage', [ReportController::class, 'ReportPage']);
