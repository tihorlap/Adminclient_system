<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController; // Ensure you have the correct namespace
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin dashboard route pointing to the correct index method
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Route to change user role
    Route::post('/change-role/{id}', [AdminController::class, 'changeRole'])->name('admin.change-role');
});

// Client Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
});

// routes/web.php
 

Route::get('/otp/verify', [RegisterController::class, 'showOtpVerificationForm'])->name('otp.verify');
Route::post('/otp/verify', [RegisterController::class, 'verifyOtp'])->name('otp.verify.post');
