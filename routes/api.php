<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    Route::post('patient/login', [AuthController::class, 'patientLogin']);
    Route::post('doctor/login', [AuthController::class, 'doctorLogin']);
    Route::post('admin/login', [AuthController::class, 'adminLogin']);
    Route::post('register', [AuthController::class, 'signup']);
    Route::post('password/email', [ForgotPasswordController::class,'forgot']);
    Route::post('password/reset', [ForgotPasswordController::class,'reset']);



    // admin
    Route::group(['prefix' => 'admin', 'middleware'=> ['auth:sanctum_admins']], function(){
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('doctors', DoctorController::class);
    });
});

