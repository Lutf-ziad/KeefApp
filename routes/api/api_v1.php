<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\HomeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::controller(HomeController::class)->prefix('home')->group(function () {
    Route::get('/splash-settings', 'splashSettings');
    Route::get('/home', 'home');
    Route::get('/categories', 'categories');
    Route::get('/shops', 'shops');
    Route::get('/packages', 'packages');
    Route::get('/shop/{shop_id}/products', 'products');
});
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/login-with-social', 'loginWithSocial');
    Route::post('/login-verification-otp', 'loginVerificationOtp');
    Route::post('/register', 'register');
    Route::post('/register-with-social', 'registerWithSocial');
    Route::post('/register-verification-otp', 'registerVerificationOtp');
    Route::middleware('auth:api')->group(function () {
        Route::get('/user-info', 'userInfo');
    });
    Route::post('/any-verification-otp', 'anyVerificationOtp');
    Route::post('/send-any-verification-otp', 'sendAnyVerificationOtp');
});

Route::fallback(function () {
    return throw new NotFoundHttpException();
});
