<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
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

// Route::resource( '/users', UserController::class );

// User Authentication Pages
Route::get( '/login', [UserController::class, 'loginPage'] );
Route::get( '/registration', [UserController::class, 'regiPage'] );
Route::get( '/otp', [UserController::class, 'otpPage'] );
Route::get( '/verify', [UserController::class, 'verifyotpPage'] );
Route::get( '/reset', [UserController::class, 'resetPassPage'] )
    ->middleware( [TokenVerificationMiddleware::class] );

// Dashboard Pages
Route::get( '/dashboard', [UserController::class, 'dashboardPage'] )
    ->middleware( [TokenVerificationMiddleware::class] );
Route::get( '/profile', [UserController::class, 'ProfilePage'] )
    ->middleware( [TokenVerificationMiddleware::class] );

// For Api Call

// User Registration
Route::post( '/userApiData', [UserController::class, 'storeAPIData'] );

// User Login
Route::post( '/userLogin', [UserController::class, 'userLogin'] );

// Send Otp To reset Password
Route::post( '/sendOTPCode', [UserController::class, 'SendOTPCode'] );

// Verified Otp
Route::post( '/verifiedOTP', [UserController::class, 'VerifiedOTP'] );

// TOken Verification
Route::post( '/pass-reset', [UserController::class, 'ResetPass'] );

// Log Out User
Route::get( '/logout', [UserController::class, 'logOut'] );

// User Profile Data
Route::get( '/user-profile', [UserController::class, 'UserProfile'] )
    ->middleware( [TokenVerificationMiddleware::class] );

// User Profile Update
Route::post( '/userUdate', [UserController::class, 'userUdate'] )
    ->middleware( [TokenVerificationMiddleware::class] );

Route::get( '/getEvents', [EventController::class, 'getEvents'] )
    ->middleware( [TokenVerificationMiddleware::class] );
Route::post( '/addEvents', [EventController::class, 'store'] )
    ->middleware( [TokenVerificationMiddleware::class] );
