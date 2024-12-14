<?php

use App\Http\Controllers\Admin\Event\BoostedEventController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LockScreenMiddleware;
use App\Http\Middleware\UserStatus;



// Example Admin Routes
Route::middleware([LockScreenMiddleware::class, UserStatus::class,AdminMiddleware::class, 'auth'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin-users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('/admin-events', \App\Http\Controllers\Admin\EventController::class);
    Route::get('/admin-api', [\App\Http\Controllers\Admin\DocumentationController::class,'index'])->name('admin.api');
    Route::post('/admin-events/boost', [BoostedEventController::class, 'boostEvent'])->name('events.boost');

});