<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::redirect('/', '/login');
Route::view('/login', 'login')->middleware('guest:admin');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest:admin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth:admin');
// admins routes
Route::fallback(function () {
    return throw new NotFoundHttpException();
});
