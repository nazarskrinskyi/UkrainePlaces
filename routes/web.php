<?php
use App\Http\Controllers\Admin\City\CreateCityController;
use App\Http\Controllers\Admin\City\DeleteCityController;
use App\Http\Controllers\Admin\City\EditCityController;
use App\Http\Controllers\Admin\City\IndexCityController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CKEditorUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactUsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/region/{city}', [LocationController::class, 'showByCity'])->name('location.index');

// Dashboard (requires auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CKEditor file upload
Route::post('/ckeditor/upload', [CKEditorUploadController::class, 'upload'])->name('ckeditor.upload');

Route::post('/send/contact-us', [ContactUsController::class, 'store'])->name('contact-us.upload');

// Locations
Route::prefix('location')->group(function () {
    Route::get('/create/', [LocationController::class, 'create'])->name('location.create'); // Form page
    Route::post('/create/', [LocationController::class, 'store'])->name('location.store'); // Save to DB
    Route::post('/find-by-name/', [LocationController::class, 'findByName'])->name('location.filter'); // Save to DB
    Route::get('/edit/{id}/', [LocationController::class, 'editForm'])->name('location.edit.form'); // Form page
    Route::put('/edit/{id}/', [LocationController::class, 'update'])->name('location.update'); // Save edits
    Route::delete('/delete/{id}/', [LocationController::class, 'destroy'])->name('location.delete');
    Route::get('/{id}/', [LocationController::class, 'show'])->name('location.show');
});

// Cities
Route::get('/regions', [CityController::class, 'index'])->name('city.index');

// Reviews
Route::prefix('review')->group(function () {
    Route::post('/create', [ReviewController::class, 'store'])->name('review.create');
    Route::get('/edit/{id}', [ReviewController::class, 'editForm'])->name('review.edit.form'); // Form page
    Route::put('/edit/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
});

// Admin panel routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact-us.show');

    Route::prefix('city')->group(function () {
        Route::get('/create', [CreateCityController::class, 'create'])->name('admin.city.create'); // Form page
        Route::get('/', [IndexCityController::class, 'index'])->name('admin.city.index'); // Form page
        Route::post('/create', [CreateCityController::class, 'store'])->name('admin.city.store'); // Save new city
        Route::get('/edit/{id}', [EditCityController::class, 'editForm'])->name('admin.city.edit'); // Form page
        Route::put('/edit/{id}', [EditCityController::class, 'update'])->name('admin.city.update'); // Save edits
        Route::delete('/delete/{id}', [DeleteCityController::class, 'destroy'])->name('admin.city.delete');
    });
});

require __DIR__ . '/auth.php';
