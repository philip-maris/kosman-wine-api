<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function (){
    //todo public route
    //todo customer route
    Route::controller(\App\Http\Controllers\CustomersController::class)->group(function (){
        Route::get('/read-customer', 'read');
        Route::post('/read-customer-by-id', 'readById');
    });
    //todo authentication route
    Route::controller(\App\Http\Controllers\AuthenticationsController::class)
        ->group(function (){
            Route::post('/initiate-enrollment', 'initiateEnrollment');
            Route::post('/complete-enrollment', 'completeEnrollment');
            Route::post('/initiate-forgotten-password', 'initiateForgottenPassword');
            Route::post('/complete-forgotten-password', 'completeForgottenPassword');
            Route::post('/change-password', 'changePassword');
            Route::post('/login', 'login');
            Route::post('/resend-otp', 'resendOtp');
        });



//todo authenticated route
    Route::middleware('auth:sanctum')->group(function () {
        //todo authentication protected route
        Route::controller(\App\Http\Controllers\AuthenticationsController::class)
            ->group(function (){
                Route::post('/change-password', 'changePassword');
            });
        //todo customer protected route
        Route::controller(\App\Http\Controllers\CustomersController::class)->group(function (){
            Route::post('/update-customer', 'update');
        });
    });
});


