<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ApplicantController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EnquiryController;
use App\Http\Controllers\Api\V1\JobController;
use App\Http\Controllers\Api\V1\UserController;



// Return a simple welcome message on the root URL
Route::get('/test', function () {
    return response()->json(['message' => 'Welcome to Gemini API']);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('/jobs', JobController::class);
    Route::apiResource('/users', UserController::class);
//    Route::apiResource('/enquiries', EnquiryController::class);
    Route::apiResource('/applicants', ApplicantController::class);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);


    Route::post('/enquiries', [EnquiryController::class, 'store']);
    Route::post('/applicants', [ApplicantController::class, 'store']);


    Route::post('/verify', [AuthController::class, 'verify']);
    Route::post('/resend-code', [AuthController::class, 'sendCode']);
    Route::post('/forgot-password', [AuthController::class, 'sendCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/change-password', [AuthController::class, 'changePassword']);
});

