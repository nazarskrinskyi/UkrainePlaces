<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CKEditorUploadController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\CityController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

Route::get('/region/{city}', [LocationController::class, 'showByCity'])->name('location.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/ckeditor/upload', [CKEditorUploadController::class, 'upload'])->name('ckeditor.upload');

Route::post('/send/contact-us', [ContactUsController::class, 'store'])->name('contact-us.upload');

// Locations
Route::prefix('location')->group(function () {
    Route::get('/create/', [LocationController::class, 'create'])->name('location.create');
    Route::post('/create/', [LocationController::class, 'store'])->name('location.store');
    Route::post('/find-by-name/', [LocationController::class, 'findByName'])->name('location.filter');
    Route::get('/edit/{id}/', [LocationController::class, 'editForm'])->name('location.edit.form');
    Route::put('/edit/{id}/', [LocationController::class, 'update'])->name('location.update');
    Route::delete('/delete/{id}/', [LocationController::class, 'destroy'])->name('location.delete');
    Route::get('/{id}/', [LocationController::class, 'show'])->name('location.show');
});

Route::get('/regions', [CityController::class, 'index'])->name('city.index');
Route::get('/navigate/{id}', [LocationController::class, 'navigateToLocation'])->name('location.navigate');

// Reviews
Route::prefix('review')->group(function () {
    Route::post('/create', [ReviewController::class, 'store'])->name('review.create');
    Route::get('/edit/{id}', [ReviewController::class, 'editForm'])->name('review.edit.form');
    Route::put('/edit/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
});
