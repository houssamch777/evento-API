<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoMarketController;
use App\Http\Controllers\LockScreenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LockScreenMiddleware;
use App\Http\Controllers\SkillController;


Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::view('/login','auth.login')->name('login')->middleware('guest');



Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::view('/logout','auth.logout')->name('logout')->middleware('guest');


Route::post('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::view('/register','auth.register')->name('register')->middleware('guest');



Route::view('/help','dashboard.help')->name('help');









Route::get('/lock-screen', [LockScreenController::class, 'show'])->name('lock.screen');
    Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
    Route::post('/manual-lock', [LockScreenController::class, 'manualLock'])->name('manual.lock');
Route::middleware(LockScreenMiddleware::class)->group(function () {


    

    Route::view('/profile/skill','user.add-skill')->name('skill');

    Route::post('/profile/image/upload', [UserController::class, 'profile_image_upload'])->name('profile.image.upload');
    Route::post('/profile/portfolio', [UserController::class, 'add_Portfolios'])->name('profile.portfolio');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile')->middleware('auth');
    Route::delete('/profile/portfolio/{id}', [UserController::class, 'destroy_Portfolio_web'])->name('portfolio.delete');



    Route::resource('skills', SkillController::class)->middleware('auth');
    Route::resource('market', EventoMarketController::class)->middleware('auth');
});






























Route::get('/foo', function () {
    Artisan::call('storage:link');
});
