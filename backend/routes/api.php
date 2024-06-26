<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\DepartamentController;
use App\Http\Controllers\Api\TrainStationController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('post', [PostController::class, 'index']);
Route::get('post/full', [PostController::class, 'full']);
Route::get('post/{id}', [PostController::class, 'show']);
Route::get('post/full/{id}', [PostController::class, 'show_full']);

Route::get('municipality', [MunicipalityController::class, 'index']);
Route::get('departament', [DepartamentController::class, 'index']);
Route::get('trainstations', [TrainStationController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('post/{id}/comments', [PostController::class, 'show_comments']);
    Route::post('post', [PostController::class, 'store']);
    Route::put('post/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'destroy']);

    Route::post('comment/', [CommentController::class, 'store']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);

    Route::get('profile/{id}', [UserController::class, 'show']);
    Route::get('profile/full/{id}', [UserController::class, 'show_full']);
    Route::get('profile', [UserController::class, 'show_auth']);
    Route::put('profile', [UserController::class, 'update']);
});

