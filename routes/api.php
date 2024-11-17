<?php

use App\Http\Controllers\API\AssetsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventApiController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\apiTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Routes

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// User Routes with 'auth:sanctum' Middleware
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    // Profile Routes
    Route::get('/', function (Request $request) {
        if (!Auth::guard('sanctum')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Session is expired.',
                'data' => null,
            ], 401);
        }

        $user = Auth::guard('sanctum')->user();
        return response()->json([
            'success' => true,
            'message' => 'Already logged in.',
            'data' => $user,
        ], 200);
    });

    // User Skills and Portfolio
    Route::get('/skills', fn(Request $request) => $request->user()->skills);
    Route::get('/portfolios', fn(Request $request) => $request->user()->portfolios);
    Route::post('/profile_picture', [UserController::class, 'uploadProfileImage']);
    Route::post('/store_portfolio', [UserController::class, 'storePortfolio']);
    Route::delete('/delete_portfolio/{id}', [UserController::class, 'destroyPortfolio']);
});

// Skill Management Routes
Route::middleware('auth:sanctum')->prefix('skills')->name('skills.')->group(function () {
    Route::get('/', [SkillController::class, 'index'])->name('index');
    Route::get('/names', [SkillController::class, 'skillsNames'])->name('names');
    Route::post('/', [SkillController::class, 'store'])->name('store');
    Route::get('/{skill}', [SkillController::class, 'show'])->name('show');
    Route::put('/{skill}', [SkillController::class, 'update'])->name('update');
    Route::delete('/{skill}', [SkillController::class, 'destroy'])->name('destroy');
});

// Event Routes
Route::middleware('auth:sanctum')->prefix('events')->group(function () {
    Route::get('/', [EventApiController::class, 'index']);
    Route::get('/my-events', [EventApiController::class, 'userEvents']);
    Route::post('/', [EventApiController::class, 'store']);
    Route::get('/domains', [EventApiController::class, 'getDomains']);
    Route::get('/categories', [EventApiController::class, 'getCategories']);
    // Other event-related routes can be added here
});

// Asset Management Routes
Route::apiResource('assets', AssetsController::class)->middleware('auth:sanctum');














Route::post('/upload-image', [apiTestController::class, 'uploadImage']);
