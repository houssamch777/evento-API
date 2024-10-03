<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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