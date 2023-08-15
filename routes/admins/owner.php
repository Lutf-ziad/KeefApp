<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['OwnerAuth'])->group(function () {
    Route::view('/dashboard', 'admins.owner.dashboard')->name('owner.dashboard');
});
