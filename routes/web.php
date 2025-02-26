<?php

use App\Http\Controllers\Admin\Place\CreatePlaceController;
use App\Http\Controllers\Admin\Place\DeletePlaceController;
use App\Http\Controllers\Admin\Place\EditPlaceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CKEditorUploadController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Place\IndexPlaceController;
use App\Http\Controllers\Place\ShowPlaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/ckeditor/upload', [CKEditorUploadController::class, 'upload'])->name('ckeditor.upload');

Route::get('/location/{id}', [ShowPlaceController::class, 'index'])->name('location.show');

Route::get('/locations/{city?}', [IndexPlaceController::class, 'index'])->name('location.index');

Route::post('/location/create', [LocationController::class, 'store'])->name('location.save');

Route::get('/location/edit/{id}', [EditPlaceController::class, 'index'])->name('location.edit');

Route::get('/location/delete/{id}', [DeletePlaceController::class, 'index'])->name('location.delete');

Route::post('/review/create', [ReviewController::class, 'store'])->name('review.save');

Route::post('/review/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');

Route::post('/review/delete/{id}', [ReviewController::class, 'delete'])->name('review.delete');

Route::get('/cities', [CityController::class, 'index'])->name('city.index');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::post('/admin/city/create', [CityController::class, 'store'])->name('city.save');

Route::post('/admin/city/edit/{id}', [CityController::class, 'edit'])->name('city.edit');

Route::post('/admin/city/delete/{id}', [CityController::class, 'delete'])->name('city.delete');

require __DIR__.'/auth.php';
