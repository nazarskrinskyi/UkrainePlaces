<?php

use App\Http\Controllers\Admin\Place\CreatePlaceController;
use App\Http\Controllers\Admin\Place\DeletePlaceController;
use App\Http\Controllers\Admin\Place\EditPlaceController;
use App\Http\Controllers\CKEditorUploadController;
use App\Http\Controllers\Place\IndexPlaceController;
use App\Http\Controllers\Place\ShowPlaceController;
use App\Http\Controllers\ProfileController;
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

Route::get('/places/{id}', [ShowPlaceController::class, 'index'])->name('place.show');

Route::get('/places/{city?}', [IndexPlaceController::class, 'index'])->name('place.index');

Route::get('/places/create', [CreatePlaceController::class, 'index'])->name('place.create');

Route::get('/places/edit/{id}', [EditPlaceController::class, 'index'])->name('place.edit');

Route::get('/places/delete/{id}', [DeletePlaceController::class, 'index'])->name('place.delete');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


require __DIR__.'/auth.php';
