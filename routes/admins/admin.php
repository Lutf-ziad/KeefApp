<?php

use App\Http\Controllers\Admins\Admin\ClientController;
use App\Http\Controllers\Admins\Admin\ProductController;
use App\Http\Controllers\Admins\Admin\PromotionController;
use App\Http\Controllers\Admins\Admin\ShopController;
use App\Http\Livewire\Admins\Admin\CategoryIndex;
use App\Http\Livewire\Admins\Admin\PackageIndex;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware(['AdminAuth'])->group(function () {
    Route::view('dashboard', 'admins.admin.dashboard')->name('admin.dashboard');
    Route::redirect('/', '/admin/dashboard');
    // start route categories
    Route::get('categories', CategoryIndex::class)->name('categories');
    // end route categories
    // start route clients
    //   dd(Route::resourc);
    Route::get('clients/{client}/change-active', [ClientController::class, 'changeActive'])->name('clients.change-active')->withTrashed();
    Route::post('clients/{client}/force-delete', [ClientController::class, 'forceDelete'])->name('clients.force-delete')->withTrashed();
    Route::post('clients/{client}/restore', [ClientController::class, 'restore'])->name('clients.restore')->withTrashed();
    Route::resource('clients', ClientController::class)->withTrashed();
    // end route clients
    // start route shops
    Route::get('shops/{shop}/change-active', [ShopController::class, 'changeActive'])->name('shops.change-active')->withTrashed();
    Route::post('shops/{shop}/force-delete', [ShopController::class, 'forceDelete'])->name('shops.force-delete')->withTrashed();
    Route::post('shops/{shop}/restore', [ShopController::class, 'restore'])->name('shops.restore')->withTrashed();
    Route::resource('shops', ShopController::class)->withTrashed();
    // end route shops
    // start route products
    Route::get('products/{product}/change-active', [ProductController::class, 'changeActive'])->name('products.change-active')->withTrashed();
    Route::post('products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.force-delete')->withTrashed();
    Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore')->withTrashed();
    Route::resource('products', ProductController::class)->withTrashed();
    // end route products
    // start route promotions
    Route::get('promotions/{promotion}/change-active', [PromotionController::class, 'changeActive'])->name('promotions.change-active')->withTrashed();
    Route::post('promotions/{promotion}/force-delete', [PromotionController::class, 'forceDelete'])->name('promotions.force-delete')->withTrashed();
    Route::post('promotions/{promotion}/restore', [PromotionController::class, 'restore'])->name('promotions.restore')->withTrashed();
    Route::resource('promotions', PromotionController::class)->withTrashed();
    // end route promotions
    // start route categories
    Route::get('packages', PackageIndex::class)->name('packages');
    // end route categories
    // start artisan route
    Route::group(['prefix' => 'artisan'], function () {
        Route::get('migrate_fresh', function () {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
            Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations']);
            Artisan::call('passport:install');

            return 'success';
        });
        Route::get('optimize_clear', function () {
            Artisan::call('optimize:clear');

            return 'success';
        });
        Route::get('passport_migrate', function () {
            Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations']);
            Artisan::call('passport:install');

            return 'success';
        });
    });
    // end artisan route
});
