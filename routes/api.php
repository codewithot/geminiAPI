<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ApplicantController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EnquiryController;
use App\Http\Controllers\Api\V1\JobController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\BlogController;



// Return a simple welcome message on the root URL
Route::get('/test', function () {
    return response()->json(['message' => 'Welcome to Gemini API']);
});

// private routes
Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::get('/v1/users', [UserController::class,'index']);
    Route::post('/v1/users', [UserController::class,'store']);
    Route::get('/v1/users/{user}', [UserController::class,'show']);

    Route::post('/v1/blogs', [BlogController::class, 'store']);
    Route::post('/v1/signup', [AuthController::class, 'signup']);
    Route::post('/v1/verify', [AuthController::class, 'verify']);
});

// public routes
Route::prefix('v1')->group(function (){
    Route::apiResource('/applicants', ApplicantController::class);

    Route::apiResource('/enquiries', EnquiryController::class);
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);
    Route::get('/blogs/image/{blog}', [BlogController::class, 'blogimages']);
    Route::apiResource('/jobs', JobController::class);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::patch('/users/{user}', [UserController::class, 'update']);
});


