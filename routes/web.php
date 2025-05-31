<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\City\CreateCityController;
use App\Http\Controllers\Admin\City\DeleteCityController;
use App\Http\Controllers\Admin\City\EditCityController;
use App\Http\Controllers\Admin\City\IndexCityController;
use App\Http\Controllers\Admin\ContactUsController;

require __DIR__ . '/localized.php';

require __DIR__ . '/auth.php';

// Admin panel routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact-us.show');

    Route::prefix('city')->group(function () {
        Route::get('/create', [CreateCityController::class, 'create'])->name('admin.city.create');
        Route::get('/', [IndexCityController::class, 'index'])->name('admin.city.index');
        Route::post('/create', [CreateCityController::class, 'store'])->name(
            'admin.city.store'
        );
        Route::get('/edit/{id}', [EditCityController::class, 'editForm'])->name('admin.city.edit');
        Route::put('/edit/{id}', [EditCityController::class, 'update'])->name(
            'admin.city.update'
        );
        Route::delete('/delete/{id}', [DeleteCityController::class, 'destroy'])->name('admin.city.delete');
    });
});


