<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['PosAuth'])->group(function () {
    Route::view('/dashboard', 'admins.pos.dashboard')->name('pos.dashboard');
});
