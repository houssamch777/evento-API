<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    // Check if the user is authenticated
    if (!Auth::guard('sanctum')->check()) {
        return Response::json([
            'success' => false,
            'message' => 'session is expired.',
            'data' => null
        ], 401);
    }

    // Get the authenticated user
    $user = Auth::guard('sanctum')->user();
    // Return the user data with a success message
    return Response::json([
        'success' => true,
        'message' => 'already logged in.',
        'data' => $user
    ], 200);
});


Route::get('/user/skills', function (Request $request) {
    return $request->user()->skills;
})->middleware('auth:sanctum');
Route::get('/user/portfolios', function (Request $request) {
    return $request->user()->portfolios;
})->middleware('auth:sanctum');


Route::post('/profile_picture',[UserController::class,'uploadProfileImage'])->middleware('auth:sanctum');
Route::post('/store_Portfolio',[UserController::class,'storePortfolio'])->middleware('auth:sanctum');
Route::delete('/delete_Portfolio/{id}',[UserController::class,'destroy_Portfolio'])->middleware('auth:sanctum');


Route::post('/register',[AuthController::class,'register']);

Route::post('/login',[AuthController::class,'login']);



Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');

Route::apiResource('skills',SkillController::class);