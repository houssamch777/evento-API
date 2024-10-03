<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::view('/login','user.login')->name('login')->middleware('guest');



Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::view('/logout','user.logout')->name('logout')->middleware('guest');


Route::post('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::view('/register','user.register')->name('register')->middleware('guest');




Route::post('/profile/image/upload', [UserController::class, 'profile_image_upload'])->name('profile.image.upload');
Route::post('/profile/portfolio', [UserController::class, 'add_Portfolios'])->name('profile.portfolio');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile')->middleware('auth');


Route::delete('/profile/portfolio/{id}', [UserController::class, 'destroy_Portfolio_web'])->name('portfolio.delete');






Route::get('/foo', function () {
    Artisan::call('storage:link');
});
