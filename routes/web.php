<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventoMarketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;
use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LockScreenMiddleware;

// Public Routes
Route::get('/', [HomeController::class,'index'])->name('index');
// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.submit');

    Route::view('/logout', 'auth.logout')->name('logout.view'); // This should be used only for view; actual logout needs no view
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// Help Route
Route::view('/help', 'dashboard.help')->name('help');

// Lock Screen Routes
Route::get('/lock-screen', [LockScreenController::class, 'show'])->name('lock.screen');
Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
Route::post('/manual-lock', [LockScreenController::class, 'manualLock'])->name('manual.lock');

// Grouped Routes with Lock Screen Middleware
Route::middleware([LockScreenMiddleware::class, 'auth'])->group(function () {
    // Profile and Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    // Profile Updates
    Route::post('/profile/image/upload', [UserController::class, 'profile_image_upload'])->name('profile.image.upload');
    Route::post('/profile/portfolio', [UserController::class, 'add_Portfolios'])->name('profile.portfolio');
    Route::delete('/profile/portfolio/{id}', [UserController::class, 'destroy_Portfolio_web'])->name('portfolio.delete');

    // Skills and Market Resources
    Route::resource('skills', SkillController::class);
    Route::resource('asset', AssetController::class);
    Route::resource('market', EventoMarketController::class);

    // Events Resources
    Route::resource('events', EventController::class);
    Route::get('/my-events', [EventController::class, 'myEvents'])->name('myEvents');
    // routes/web.php
    Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');

});

// Artisan Command Route (for development or maintenance)
Route::get('/foo', function () {
    Artisan::call('storage:link');
    return redirect()->route('index');
});
